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
                <form method="POST" action="{{ route('tramite.store') }}" id="form-tramite">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-maroon">
                                <div class="card-header">
                                    <h3 class="card-title">Datos Tr&aacute;mite</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-3">Fecha y Hora</label>
                                        <div class="col-md-9">
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
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" id="anio" name ='anio'
                                                placeholder="Ingrese Nro. Documento"
                                                value={{ date('Y') }} readonly >
                                        </div>
                                        <label for="nombre" class="col-form-label col-md-3">Documento</label>
                                        <div class="col-md-5">
                                            <select class="form-control" title="Documento de trámite" id="documento_tramite_id"
                                                    name="documento_tramite_id" onchange="obtenerTipoTramiteLista(this.value)">
                                                <option value="">-Seleccionar-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">Tipo</label>
                                        <div class="col-md-10" id="tipo-tramite-partial">
                                            <select class="form-control select2" title="Documento de trámite" id="tipo_tramite_id" name="tipo_tramite_id">
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
                                    <div class="form-group row">
                                        <label for="nombre" class="col-form-label col-md-2">Folios</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" id="numero_folios" name ='numero_folios'  min="1" value="1"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header  bg-teal">
                                    <h3 class="card-title">Subir Archivos</h3>
                                </div>
                                <div class="card-body">
                                    <div id="actions" class="row">
                                        <div class="col-md-12">
                                          <div class="btn-group w-100">
                                            <span class="btn btn-success col fileinput-button">
                                              <i class="fas fa-plus"></i>
                                              <span>Agregar</span>
                                            </span>
                                            <button type="submit" class="btn btn-primary col start">
                                              <i class="fas fa-upload"></i>
                                              <span>Subir</span>
                                            </button>
                                            <button type="reset" class="btn btn-warning col cancel">
                                              <i class="fas fa-times-circle"></i>
                                              <span>Cancelar</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="col-md-12 d-flex align-items-center">
                                          <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="table table-striped files" id="previews">
                                        <div id="template" class="row mt-2">
                                          <div class="col-auto">
                                              <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                          </div>
                                            <div class="col d-flex align-items-center">
                                                <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                </p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                            </div>
                                            <div class="col-4 d-flex align-items-center">
                                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                <button class="btn btn-primary  btn-xs start" title="Subir Archivo">
                                                    <i class="fas fa-upload"></i>
                                                </button>
                                                <button data-dz-remove class="btn btn-warning btn-xs  cancel" title="Cancelar Subir Archivo">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                                <button data-dz-remove class="btn btn-danger  btn-xs delete" title="Quitar Archivo">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

