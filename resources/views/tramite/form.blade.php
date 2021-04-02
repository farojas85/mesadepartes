<div class="row">
    <div class="col-md-6">
        <div class="card card-maroon">
            <div class="card-header">
                <h3 class="card-title">Datos Tr&aacute;mite</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-1">A&ntilde;o</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="anio" name ='anio'
                            placeholder="Ingrese Nro. Documento"
                            @if($estadoCrud == 'editar')
                                value=""
                            @else
                                value={{ date('Y') }} readonly
                            @endif>
                    </div>
                    <label for="nombre" class="col-form-label col-md-3">Documento</label>
                    <div class="col-md-5">
                        <select class="form-control" title="Documento de trámite" id="documento_tramite_id" name="documento_tramite_id">
                            <option value="">-Seleccionar-</option>
                            @forelse ($documentoTramites as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre}}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-2">Tipo Tr&aacute;mite</label>
                    <div class="col-md-10" id="tipo_tramite_partial">
                        <select class="form-control" title="Documento de trámite" id="tipo_tramite_id" name="tipo_tramite_id">
                            <option value="">-Seleccionar-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-2">Asunto</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="asunto" name ='asunto' rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Subir Archivos</h3>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
