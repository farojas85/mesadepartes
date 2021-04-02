<div class="form-group row">
    <label for="nombre" class="col-form-label-sm font-weight-bold col-md-2">Documento</label>
    <div class="col-md-9">
        <select class="form-control" title="Documento de Trámite" id="documento_tramite_id" name="documento_tramite_id">
            <option value="">-Seleccionar-</option>
        @forelse ($documentoTramites as $documentoTramite)
            <option value="{{ $documentoTramite->id }}"
                @if ($estadoCrud=='editar' && $documentoTramite->id == $tipoTramite->documento_tramite_id)
                selected
                @endif>{{ $documentoTramite->nombre }}</option>
        @empty
            <option value="0">--Configurar--</option>
        @endforelse
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Nombre</label>
    <div class="col-md-9">
        <input type="text" class="form-control form-control-sm"
            id="nombre" name="nombre" placeholder="Ingrese Nombre de Tipo Trámite" @if($estadoCrud=='editar') value="{{ $tipoTramite->nombre }}" @endif>
        @error('nombre')
            <span class="invalid-feedback" tipoTramite="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-form-label col-form-label-sm font-weight-bold col-md-2">Estado</label>
    <div class="col-md-9">

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="estado" name="estado"
                @if($estadoCrud=='editar')
                    @if($tipoTramite->estado == 1)
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
    <button type="submit" class="btn btn-success" onclick="guardarTipoTramite(event)"
        value="{{ $estadoCrud }}">
        @if($estadoCrud=='nuevo')
        <i class="fas fa-save"></i> Guardar
        @else
        <i class="fas fa-retweet"></i> Modificar
        @endif
    </button>
</div>
