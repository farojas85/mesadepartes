<div class="modal" id="modal-tramite">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tramite-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-tramite-body">
                <form method="POST" action="{{ route('tramite.store') }}" id="form-tramite" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-maroon border border-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Tr&aacute;mite</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-3">Fecha y Hora</label>
                                        <div class="col-md-9 mensaje-error">
                                            <div class="input-group date" id="fechahorapicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#fechahorapicker"
                                                        id="fecha_hora" name ="fecha_hora" />
                                                <div class="input-group-append" data-target="#fechahorapicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                        &nbsp;
                                                        <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">A&ntilde;o</label>
                                        <div class="col-md-2 mensaje-error">
                                            <input type="text" class="form-control" id="anio" name ='anio'
                                                placeholder="Ingrese Nro. Documento"
                                                value={{ date('Y') }} readonly >
                                        </div>
                                        <label for="nombre" class="col-form-label col-md-3">Documento</label>
                                        <div class="col-md-5 mensaje-error">
                                            <select class="form-control" title="Documento de trámite" id="documento_tramite_id"
                                                    name="documento_tramite_id" onchange="obtenerTipoTramiteLista(this.value)">
                                                <option value="">-Seleccionar-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">Tipo</label>
                                        <div class="col-md-10 mensaje-error" id="tipo-tramite-partial">
                                            <select class="form-control select2" title="Documento de trámite" id="tipo_tramite_id" name="tipo_tramite_id">
                                                <option value="">-Seleccionar-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">Asunto</label>
                                        <div class="col-md-10 mensaje-error">
                                            <textarea class="form-control" id="asunto" name ='asunto' rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">Folios</label>
                                        <div class="col-md-10 mensaje-error">
                                            <input type="text" class="form-control" id="numero_folios" name ='numero_folios' value="1"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border border-success shadow">
                                <div class="card-header  bg-teal">
                                    <h3 class="card-title">Subir Archivos</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mensaje-error">
                                        <label for="exampleInputFile">Archivo</label>
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="archivo" name = "archivo">
                                            <label class="custom-file-label" for="exampleInputFile">-No ha Seleccionado Archivo-</label>
                                          </div>
                                          <div class="input-group-append">
                                            <span class="input-group-text bg-purple"><i class="fas fa-cloud-upload-alt"></i></span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="guardarTramite(event)">
                    <i class="fas fa-cloud-upload-alt"></i> Guardar
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

