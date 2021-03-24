<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-outline card-info">
            <div class="card-header ">
                <h3 class="card-title">
                    Listado Documentos Trámites&nbsp;
                    <button type="button" class="btn bg-maroon btn-sm rounded-pill"
                        onclick="nuevoDocumentoTramite()">
                        <i class="fas fa-plus"></i> Nuevo Doc. Trám.
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
                                    id="documento-tramite-paginacion" onchange="cambiarPaginacionDocumentoTramite()">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>&nbsp;
                            &nbsp;
                            <input type="text" name="table-search" id="table-search"
                                class="form-control"  placeholder="Buscar..." onkeyup="buscarDocumentoTramite(this.value)">
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($documento_tramites as $documento_tramite)
                                    <tr>
                                        <td class="text-center">{{  $loop->iteration-1 +$documento_tramites->firstItem() }}</td>
                                        <td> {{ $documento_tramite->nombre }}</td>
                                        <td>
                                            @if($documento_tramite)
                                            <button type="button" class="btn btn-warning btn-xs btn-editar-documento_tramite"
                                                onclick="editarDocumentoTramite({{ $documento_tramite->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs btn-eliminar-documento_tramite"
                                                onclick="eliminarDocumentoTramite({{ $documento_tramite->id }})" title="Eliminar Documento Trámite">
                                                <i class="fas fa-trash"></i>
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
                            @if($documento_tramites->currentPage() > 1)
                            <li class="page-item">
                                <a class="page-link btn" aria-label="First"
                                onclick="cambiarPaginaDocumentoTramite(1)">
                                    <span><i class="fas fa-fast-backward"></i></span>
                                </a>
                            </li>
                            @endif
                            @for ($i = 1; $i <=$documento_tramites->lastPage() ; $i++)
                            <li class="page-item @if($i== $documento_tramites->currentPage()) active @endif">
                                <a class="page-link btn" onclick="cambiarPaginaDocumentoTramite({{ $i }})">{{ $i }}</a>
                            </li>
                            @endfor
                            @if($documento_tramites->currentPage() < $documento_tramites->lastPage() )
                            <li class="page-item">
                                <a class="page-link btn" aria-label="First"
                                onclick="cambiarPaginaDocumentoTramite({{ $documento_tramites->lastPage() }})">
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
