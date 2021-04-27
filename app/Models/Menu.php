<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['id','nombre','enlace','imagen','padre_id','orden','estado'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function padre()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class,'padre_id');
    }

    public static function maximoPadreId()
    {
        $countfilas = Menu::whereNull('padre_id')->count();

        return ($countfilas ==0) ? 0 : (Menu::whereNull('padre_id')->max('orden')+1);
    }

    public static function maximoHijoId($padre_id)
    {
        $countfilas= Menu::where('padre_id',$padre_id)->count();

        return ($countfilas == 0) ? 0 : Menu::where('padre_id',$padre_id)->max('orden') + 1 ;
    }

    public static function menusPadres($front){
        //Obtenemos el Id del Rol del usuario Autenticado
        if($front) {
            return Menu::whereHas('roles', function ($query) {
                $role_id = Auth::user()->role_id;
                $query->where('role_id',$role_id)->orderby('padre_id');
            })->where('estado',1)->whereNull('padre_id')->orderby('orden')->get()->toArray();
        } else {
            return Menu::orderby('padre_id')->orderby('orden')->get()->toArray();
        }
    }

    public function menusHijos($padres)
    {
        $children = [];
        foreach ($padres as $line1) {
            $hijos = Menu::whereHas('roles', function ($query) {
                        $role_id = Auth::user()->role_id;
                        $query->where('role_id',$role_id)->orderby('padre_id');
                    })->where('estado',1)->where('padre_id',$line1['id'])->orderby('orden')->get()->toArray();

            $children = array_merge($children, [array_merge($line1, ['submenu' => $hijos ])]);
        }
        return $children;
    }

    public static function getMenus($front = false)
    {
        $menus = new Menu();
        $padres = $menus->menusPadres($front);
        return $menus->menusHijos($padres);
    }
}
