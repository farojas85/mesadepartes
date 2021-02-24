<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-outline card-info">
            <div class="card-header ">
                <h3 class="card-title">
                    Listado Roles&nbsp;
                    <button type="button" class="btn bg-maroon btn-sm rounded-pill"
                        onclick="nuevoRol()">
                        <i class="fas fa-plus"></i> Nuevo Rol
                    </button>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <label class="col-form-label col-form-label-sm">Mostrar&nbsp;</label>
                                <select class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>&nbsp;
                            <select  class="form-control form-control-sm" onchange="mostrarFiltroRole(this.value)"
                                id="filtro-role">
                                <option value="">-Filtro-</option>
                                <option value="todos">Todos</option>
                                <option value="habilitados">habilitados</option>
                                <option value="eliminados">Eliminados</option>

                            </select>
                            &nbsp;
                            <input type="text" name="table-search" id="table-search"
                                class="form-control"  placeholder="Buscar..." onkeyup="buscarRole(this.value)">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"  id="detalle-tabla">
                    <div class="col-md-12 mb-2">
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
                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
