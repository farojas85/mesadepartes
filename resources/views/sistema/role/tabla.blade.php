<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">nombre</th>
                    <th class="text-center">Directriz</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$roles->firstItem() }}</td>
                    <td> {{ $role->nombre }}</td>
                    <td> {{ $role->directriz }}</td>
                    <td class="text-center">
                        <span class="{{ $role->clase_estado }}">{{ $role->nombre_estado }}</span>
                    </td>
                    <td>
                        @if($role->deleted_at == null)
                            <button type="button" class="btn btn-warning btn-xs btn-editar-role"
                                onclick="editarRole({{ $role->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs btn-eliminar-role"
                                onclick="eliminarRole({{ $role->id }})" title="Eliminar Role">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <button type="button" class="btn bg-purple btn-xs btn-restaurar-role"
                                onclick="restaurarRole({{ $role->id }})" title="Restaurar Role">
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
        @if($roles->currentPage() > 1)
        <li class="page-item">
            <a href="#" aria-label="Previous" class="page-link btn">
                <span><i class="fas fa-fast-backward"></i></span>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <=$roles->lastPage() ; $i++)
        <li class="page-item">
            <a class="page-link btn" onclick="cambiarPaginaRole({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
