<div class="col-md-12 mb-2">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Enlace</th>
                    <th class="text-center">Icono</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$menus->firstItem() }}</td>
                    <td> {{ $menu->nombre }}</td>
                    <td> {{ $menu->enlace }}</td>
                    <td class="text-center"><i class="{{ $menu->imagen }}"></i></td>
                    <td class="text-center"><span class="{{ $menu->estado_clase }}">{{ $menu->estado_nombre }}</span></td>
                    <td>
                        @if($menu->estado == 1)
                        <button type="button" class="btn btn-warning btn-xs btn-editar-menu"
                            onclick="editarMenu({{ $menu->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs btn-eliminar-menu"
                            onclick="eliminarMenu({{ $menu->id }})" title="Eliminar menu">
                            <i class="fas fa-trash"></i>
                        </button>
                        @else
                        <button type="button" class="btn bg-purple btn-xs btn-restaurar-menu"
                            onclick="restaurarMenu({{ $menu->id }})" title="Restaurar menu">
                            <i class="fas fa-trash-restore-alt"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-danger">
                        -- Datos No Registrados --
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <ul class="pagination">
        @if($menus->currentPage() > 1)
        <li class="page-item">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaMenu(1)">
                <span><i class="fas fa-fast-backward"></i></span>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <=$menus->lastPage() ; $i++)
        <li class="page-item @if($i== $menus->currentPage()) active @endif">
            <a class="page-link btn" onclick="cambiarPaginaMenu({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
        @if($menus->currentPage() < $menus->lastPage() )
        <li class="page-item">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaMenu({{ $menus->lastPage() }})">
                <span><i class="fas fa-fast-forward"></i></span>
            </a>
        </li>
        @endif
    </ul>
    {{-- {{ $menus->links() }} --}}
</div>
