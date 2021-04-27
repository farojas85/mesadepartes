<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">nombre</th>
                    <th class="text-center">Directriz</th>
                    <th class="text-center">Descripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permisos as $permiso)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$permisos->firstItem() }}</td>
                    <td> {{ $permiso->nombre }}</td>
                    <td> {{ $permiso->directriz }}</td>
                    <td> {{ $permiso->descripcion }}</td>

                    <td>
                        @if($permiso->deleted_at == null)
                            <button type="button" class="btn btn-warning btn-xs btn-editar-permiso"
                                onclick="editarPermiso({{ $permiso->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs btn-eliminar-permiso"
                                onclick="eliminarPermiso({{ $permiso->id }})" title="Eliminar Permiso">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <button type="button" class="btn bg-purple btn-xs btn-restaurar-Permiso"
                                onclick="restaurarPermiso({{ $permiso->id }})" title="Restaurar permiso">
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
        @if($permisos->currentPage() > 1)
        <li class="page-item">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaPermiso(1)">
                <span><i class="fas fa-fast-backward"></i></span>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <=$permisos->lastPage() ; $i++)
        <li class="page-item @if($i==$permisos->currentPage()) active @endif">
            <a class="page-link btn" onclick="cambiarPaginaPermiso({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
        @if($permisos->currentPage() < $permisos->lastPage() )
        <li class="page-item ">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaPermiso({{ $permisos->lastPage() }})">
                <span><i class="fas fa-fast-forward"></i></span>
            </a>
        </li>
        @endif
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
