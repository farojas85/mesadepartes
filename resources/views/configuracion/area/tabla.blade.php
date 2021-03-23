<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombres</th>
                    <th class="text-center">Siglas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($areas as $area)
                <tr>
                    <td class="text-center">{{  $loop->iteration-1 +$areas->firstItem() }}</td>
                    <td> {{ $area->nombre }}</td>
                    <td> {{ $area->siglas }}</td>
                    <td>
                        @if($area->deleted_at == null)
                        <button type="button" class="btn btn-warning btn-xs btn-editar-area"
                            onclick="editarArea({{ $area->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs btn-eliminar-area"
                            onclick="eliminarArea({{ $area->id }})" title="Eliminar Area">
                            <i class="fas fa-trash"></i>
                        </button>
                        @else
                        <button type="button" class="btn bg-purple btn-xs btn-restaurar-area"
                            onclick="restaurarArea({{ $area->id }})" title="Restaurar Area">
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
        @if($areas->currentPage() > 1)
        <li class="page-item">
            <a href="#" aria-label="Previous" class="page-link btn">
                <span><i class="fas fa-fast-backward"></i></span>
            </a>
        </li>
        @endif
        @for ($i = 1; $i <=$areas->lastPage() ; $i++)
        <li class="page-item">
            <a class="page-link btn" onclick="cambiarPaginaArea({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
