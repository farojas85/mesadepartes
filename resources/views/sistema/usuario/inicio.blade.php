<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-outline card-info">
            <div class="card-header ">
                <h3 class="card-title">
                    Listado Usuario&nbsp;
                    <button type="button" class="btn bg-maroon btn-sm rounded-pill"
                        onclick="nuevoUsuario()">
                        <i class="fas fa-plus"></i> Nuevo Usuario
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
                            <select  class="form-control form-control-sm" onchange="mostrarFiltroUsuario(this.value)"
                                id="filtro-role">
                                <option value="">-Filtro-</option>
                                <option value="todos">Todos</option>
                                <option value="habilitados">habilitados</option>
                                <option value="eliminados">Eliminados</option>

                            </select>
                            &nbsp;
                            <input type="text" name="table-search" id="table-search"
                                class="form-control"  placeholder="Buscar..." onkeyup="buscarUsuario(this.value)">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"  id="detalle-tabla">
                    <div class="col-md-12 mb-1">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead class="bg-navy">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Nombres y Apellidos</th>
                                        <th class="text-center">Cargo</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usuarios as $usuario)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration-1 +$usuarios->firstItem() }}</td>
                                        <td class="text-center">{{ $usuario->usuario_codigo }}</td>
                                        <td class="text-center">{{ $usuario->nombre_usuario }}</td>
                                        <td class="text-center">{{ $usuario->cargo }}</td>
                                        <td class="text-center">{{ $usuario->rol }}</td>
                                        <td class="text-center">
                                            <span class="{{ $usuario->estado_clase }}">{{ $usuario->estado_nombre }}</span>
                                        </td>
                                        <td>
                                            @if($usuario->deleted_at == null)
                                            <button type="button" class="btn btn-info btn-xs btn-mostrar-usuario"
                                                onclick="mostrarUsuario({{ $usuario->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-xs btn-editar-usuario"
                                                onclick="editarUsuario({{ $usuario->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs btn-eliminar-usuario"
                                                onclick="eliminarUsuario({{ $usuario->id }})" title="Eliminar Usuario">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn bg-purple btn-xs btn-restaurar-usuario"
                                                onclick="restaurarUsuario({{ $usuario->id }})" title="Restaurar Usuario">
                                                <i class="fas fa-trash-restore-alt"></i>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="7">--Datos No Registrados--</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="pagination">
                            @if($usuarios->currentPage() > 1)
                            <li class="page-item">
                                <a href="#" aria-label="Previous" class="page-link btn">
                                    <span><i class="fas fa-fast-backward"></i></span>
                                </a>
                            </li>
                            @endif
                            @for ($i = 1; $i <=$usuarios->lastPage() ; $i++)
                            <li class="page-item">
                                <a class="page-link btn" onclick="cambiarPaginaUsuario({{ $i }})">{{ $i }}</a>
                            </li>
                            @endfor
                        </ul>
                        {{-- {{ $roles->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
