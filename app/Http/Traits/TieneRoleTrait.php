<?php
namespace App\Http\Traits;
use Illuminate\Support\Str;
use App\Http\Traits\TienePermisoTrait;


trait TieneRoleTrait
{
    use TienePermisoTrait;

    public function asignarRole($role)
    {
        $this->roles()->sync($role);
    }

    public function eliminarRole()
    {
        $this->roles()->detach();
    }

    public function tieneRole($role)
    {
        $directriz = Str::slug($role->directriz);

        return (bool) $this->where('directriz', $directriz)->count();
    }

    public function tieneAlgunRole($roles)
    {
        foreach ($roles as $role) {
            if ($this->tieneRole($role)) {
                return true;
            }
        }
        return false;
    }

}
