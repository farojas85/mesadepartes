<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documento_tramites as $documento_tramite)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$documento_tramites->firstItem() }}</td>
                    <td> {{ $documento_tramite->nombre }}</td>
                    <td>
                        @if($documento_tramite->deleted_at == null)
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
        <li class="page-item @if($i==$documento_tramites->currentPage()) active @endif">
            <a class="page-link btn" onclick="cambiarPaginaDocumentoTramite({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
        @if($documento_tramites->currentPage() < $documento_tramites->lastPage() )
        <li class="page-item ">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaDocumentoTramite({{ $documento_tramites->lastPage() }})">
                <span><i class="fas fa-fast-forward"></i></span>
            </a>
        </li>
        @endif
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
