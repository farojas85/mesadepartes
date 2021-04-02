<div class="col-md-12 mb-2">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Documento Tr&aacute;mite</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipoTramites as $tipoTramite)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$tipoTramites->firstItem() }}</td>
                    <td>{{ $tipoTramite->documento_tramite->nombre }}</td>
                    <td> {{ $tipoTramite->nombre }}</td>
                    <td class="text-center">
                        <span class="{{ $tipoTramite->estado_clase }}">{{ $tipoTramite->estado_nombre }}</span>
                    </td>
                    <td>
                        @if($tipoTramite)
                        <button type="button" class="btn btn-warning btn-xs btn-editar-tipoTramite"
                            onclick="editarTipoTramite({{ $tipoTramite->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs btn-eliminar-tipoTramite"
                            onclick="eliminarTipoTramite({{ $tipoTramite->id }})" title="Eliminar Tipo Trámite">
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
        @if($tipoTramites->currentPage() > 1)
        <li class="page-item">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaTipoTramite(1)">
                <span><i class="fas fa-fast-backward"></i></span>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <=$tipoTramites->lastPage() ; $i++)
        <li class="page-item @if($i== $tipoTramites->currentPage()) active @endif">
            <a class="page-link btn" onclick="cambiarPaginaTipoTramite({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
        @if($tipoTramites->currentPage() < $tipoTramites->lastPage() )
        <li class="page-item">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaTipoTramite({{ $tipoTramites->lastPage() }})">
                <span><i class="fas fa-fast-forward"></i></span>
            </a>
        </li>
        @endif
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
