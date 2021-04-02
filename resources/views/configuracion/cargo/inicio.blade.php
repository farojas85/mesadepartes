<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-outline card-info">
            <div class="card-header ">
                <h3 class="card-title">
                    Listado Cargos&nbsp;
                    <button type="button" class="btn bg-maroon btn-sm rounded-pill"
                        onclick="nuevoCargo()">
                        <i class="fas fa-plus"></i> Nuevo Cargo
                    </button>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <label class="col-form-label col-form-label-sm">Mostrar&nbsp;</label>
                                <select class="custom-select custom-select-sm form-control form-control-sm"
                                    id="cargo-paginacion" onchange="cambiarPaginacionCargo()">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>&nbsp;
                            <select  class="form-control form-control-sm" onchange="mostrarFiltroCargo(this.value)"
                                id="filtro-cargo">
                                <option value="">-Filtro-</option>
                                <option value="todos">Todos</option>
                                <option value="habilitados">habilitados</option>
                                <option value="eliminados">Eliminados</option>

                            </select>
                            &nbsp;
                            <input type="text" name="table-search" id="table-search"
                                class="form-control"  placeholder="Buscar..." onkeyup="buscarCargo(this.value)">
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
                                        <th class="text-center">Nombres</th>
                                        <th class="text-center">Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cargos as $cargo)
                                    <tr>
                                        <td class="text-center">{{  $loop->iteration-1 +$cargos->firstItem() }}</td>
                                        <td> {{ $cargo->nombre }}</td>
                                        <td class="text-center">
                                            <span class="{{ $cargo->clase_estado }}">{{ $cargo->nombre_estado }}</span>
                                        </td>
                                        <td>
                                            @if($cargo->deleted_at == null)
                                            <button type="button" class="btn btn-warning btn-xs btn-editar-cargo"
                                                onclick="editarCargo({{ $cargo->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs btn-eliminar-cargo"
                                                onclick="eliminarCargo({{ $cargo->id }})" title="Eliminar Cargo">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn bg-purple btn-xs btn-restaurar-cargo"
                                                onclick="restaurarCargo({{ $cargo->id }})" title="Restaurar Cargo">
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
                            @if($cargos->currentPage() > 1)
                            <li class="page-item">
                                <a class="page-link btn" aria-label="First"
                                onclick="cambiarPaginaCargo(1)">
                                    <span><i class="fas fa-fast-backward"></i></span>
                                </a>
                            </li>
                            @endif
                            @for ($i = 1; $i <=$cargos->lastPage() ; $i++)
                            <li class="page-item @if($i== $cargos->currentPage()) active @endif">
                                <a class="page-link btn" onclick="cambiarPaginaCargo({{ $i }})">{{ $i }}</a>
                            </li>
                            @endfor
                            @if($cargos->currentPage() < $cargos->lastPage() )
                            <li class="page-item">
                                <a class="page-link btn" aria-label="First"
                                onclick="cambiarPaginaCargo({{ $cargos->lastPage() }})">
                                    <span><i class="fas fa-fast-forward"></i></span>
                                </a>
                            </li>
                            @endif
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
