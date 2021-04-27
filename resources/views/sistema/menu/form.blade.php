<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Nombre</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="nombre" name="nombre" placeholder="Ingrese Nombre" @if($estadoCrud=='editar') value="{{ $menu->nombre }}" @endif>
        @error('nombre')
            <span class="invalid-feedback" menu="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Enlace</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="enlace" name="enlace" placeholder="Ingrese enlace" @if($estadoCrud=='editar') value="{{ $menu->enlace }}" @endif>
        @error('enlace')
            <span class="invalid-feedback" menu="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Imagen</label>
    <div class="col-md-10">
        <input type="text" class="form-control form-control-sm"
            id="imagen" name="imagen" placeholder="Ingrese Descripción" @if($estadoCrud=='editar') value="{{ $menu->imagen }}" @endif>
        @error('imagen')
            <span class="invalid-feedback" menu="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="nombre" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Padre</label>
    <div class="col-md-10">
        <select class="form-control" title="Padre" id="padre_id" name="padre_id">
            <option value="">-Seleccionar-</option>
        @forelse ($padres as $padre)
            <option value="{{ $padre->id }}"
                @if ($estadoCrud=='editar' && $padre->id == $menu->padre_id)
                selected
                @endif>{{ $padre->nombre }}</option>
        @empty
            <option value="0">--Configurar--</option>
        @endforelse
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Estado</label>
    <div class="col-md-10">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="estado" name="estado"
                @if($estadoCrud=='editar')
                    @if($menu->estado == 1)
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
    <button type="button" class="btn btn-success" onclick="guardarMenu()"
        value="{{ $estadoCrud }}">
        @if($estadoCrud=='nuevo')
        <i class="fas fa-save"></i> Guardar
        @else
        <i class="fas fa-retweet"></i> Modificar
        @endif
    </button>
</div>
