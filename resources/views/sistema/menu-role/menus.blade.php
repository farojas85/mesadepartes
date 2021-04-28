<div class="card card-info border border-info">
    <div class="card-header">
        <h3 class="card-title">Men&uacute;s Para... <b>{{ $role->nombre }}</b></h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('menu-role.store') }}" id="form-menu-role">
            @csrf
            <input type="hidden" name="menu_role_id" id="menu_role_id" value="{{ $role->id }}">
            <div class="tab-content pt-0" id="tab-contenido">
                @forelse ($menus as $menu)
                    @php
                        $encontrado = '';
                        foreach ($role->menus as $role_menu) {
                            if($menu->id == $role_menu->id)
                            {
                                $encontrado = 'checked';
                            }
                        }
                    @endphp
                    <dl>
                        <input type="checkbox" id="menu_role[]"  name="menu_role[]" {{ $encontrado }} value="{{ $menu->id }}">
                        {{ $menu->nombre }}
                        @if( !is_null($menu->enlace))
                        <small>Enlace({{ $menu->enlace }})</small>
                        @endif
                    </dl>
                @empty

                @endforelse
                <div class="row container-fluid text-center">
                    <button type="button" class="btn btn-success" onclick="guardarMenuRole()">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
