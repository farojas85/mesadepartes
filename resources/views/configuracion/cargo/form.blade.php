<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Nombre</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="nombre" name="nombre" placeholder="Ingrese Nombre Cargo" @if($estadoCrud=='editar') value="{{ $cargo->nombre }}" @endif>
        @error('nombre')
            <span class="invalid-feedback" cargo="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Estado</label>
    <div class="col-md-10">

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="estado" name="estado"
                @if($estadoCrud=='editar')
                    @if($cargo->estado == 1)
                    checked
                    @endif
                @else
                    checked
                @endif
            >
            <label for="estado" class="custom-control-label">
                Activo
            </label>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fas fa-times"></i> Cancelar
    </button>
    <button type="button" class="btn btn-success" onclick="guardarCargo()"
        value="{{ $estadoCrud }}">
        @if($estadoCrud=='nuevo')
        <i class="fas fa-save"></i> Guardar
        @else
        <i class="fas fa-retweet"></i> Modificar
        @endif
    </button>
</div>
