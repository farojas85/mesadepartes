<div class="card card-info border border-info">
    <div class="card-header">
        <h3 class="card-title">Permisos Para... <b>{{ $role->nombre }}</b></h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('permiso-role.store') }}" id="form-permiso-role">
            @csrf
            <input type="hidden" name="permiso_role_id" id="permiso_role_id" value="{{ $role->id }}">
            <div class="tab-content pt-0" id="tab-contenido">
                @forelse ($permisos as $permiso)
                    @php
                        $encontrado = '';
                        foreach ($role->permisos as $role_permiso) {
                            if($permiso->id == $role_permiso->id)
                            {
                                $encontrado = 'checked';
                            }
                        }
                    @endphp
                    <dl>
                        <input type="checkbox" id="permiso_role[]"  name="permiso_role[]" {{ $encontrado }} value="{{ $permiso->id }}">
                        {{ $permiso->nombre }}
                        @if( !is_null($permiso->descripcion))
                        <small>({{ $permiso->descripcion }})</small>
                        @endif
                    </dl>
                @empty

                @endforelse
                @puede('permiso-role.guardar')
                <div class="row container-fluid text-center">
                    <button type="button" class="btn btn-success" onclick="guardarPermisoRole()">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
                @endpuede
            </div>
        </form>
    </div>
</div>
