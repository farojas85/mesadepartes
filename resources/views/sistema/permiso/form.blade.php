<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Nombre</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="nombre" name="nombre" placeholder="Ingrese Nombre" @if($estadoCrud=='editar') value="{{ $permiso->nombre }}" @endif>
        @error('nombre')
            <span class="invalid-feedback" permiso="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Directriz</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="directriz" name="directriz" placeholder="Ingrese Directriz" @if($estadoCrud=='editar') value="{{ $permiso->directriz }}" @endif>
        @error('directriz')
            <span class="invalid-feedback" permiso="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Descripción</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="descripcion" name="descripcion" placeholder="Ingrese Descripción" @if($estadoCrud=='editar') value="{{ $permiso->descripcion }}" @endif>
        @error('descripcion')
            <span class="invalid-feedback" permiso="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fas fa-times"></i> Cancelar
    </button>
    <button type="button" class="btn btn-success" onclick="guardarPermiso()"
        value="{{ $estadoCrud }}">
        @if($estadoCrud=='nuevo')
        <i class="fas fa-save"></i> Guardar
        @else
        <i class="fas fa-retweet"></i> Modificar
        @endif
    </button>
</div>
