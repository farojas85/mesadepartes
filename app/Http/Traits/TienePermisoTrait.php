<?php
namespace App\Http\Traits;

use App\Models\Permiso;
use App\Models\Role;
use Illuminate\Database\Query\Builder;

trait TienePermisoTrait
{
    public function asignarPermisos($permisos)
    {
        if(is_array($permisos))
        {
            $this->permisos()->sync($permisos);
        } else{
            if(count($this->permisos) == 0){
                $this->permisos()->attach($permisos);
            } else {
                foreach($this->permisos as $permiso)
                {
                    if($permiso->id != $permisos)
                    {
                        $this->permisos()->attach($permisos);
                    }
                }
            }
        }
    }

    public function tienePermisoDe($permiso)
    {
        $permisos  = ($this->permisos()->where('directriz',$permiso)->count());
        if($permisos>0)
        {
            return true;
        }

        return false;
    }

    public function tieneAlgunPermiso($permiso)
    {
        // foreach ($roles as $role) {
        //     if ($this->tieneRole($role)) {
        //         return true;
        //     }
        // }
        // return false;
    }


}
