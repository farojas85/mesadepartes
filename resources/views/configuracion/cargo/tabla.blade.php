<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
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
        <li class="page-item @if($i==$cargos->currentPage()) active @endif">
            <a class="page-link btn" onclick="cambiarPaginaCargo({{ $i }})">{{ $i }}</a>
        </li>
        @endfor
        @if($cargos->currentPage() < $cargos->lastPage() )
        <li class="page-item ">
            <a class="page-link btn" aria-label="First"
            onclick="cambiarPaginaCargo({{ $cargos->lastPage() }})">
                <span><i class="fas fa-fast-forward"></i></span>
            </a>
        </li>
        @endif
    </ul>
    {{-- {{ $roles->links() }} --}}
</div>
