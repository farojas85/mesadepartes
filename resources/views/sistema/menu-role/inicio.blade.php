<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-outline card-info">
            <div class="card-header ">
                <h3 class="card-title">
                    Listado Men&uacute;&nbsp;/&nbsp;Role
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-maroon border border-danger">
                            <div class="card-header">
                                <h3 class="card-title">Roles</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-form-label-sm col-md-2">Rol</label>
                                    <div class="col-md-10">
                                        <select name="role_id" id="role_id" class="form-control form-control-sm">
                                            <option value="">-Seleccionar-</option>
                                        @forelse ($roles as $rol)
                                            <option value="{{ $rol->id }}">{{$rol->nombre}}</option>
                                        @empty
                                            <option value="00">-Configuraci&oacute;n-</option>
                                        @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col md-12 text-center">
                                        <button type="button" class="btn btn-success" onclick="generarMenuRole()" >
                                            <i class="fas fa-check"></i> Generar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" id="detalle-menus">
                        <div class="callout callout-success border-bottom border-right border-top border-success">
                            <h5 class="text-primary font-weight-bold">Seleccionar un Rol</h5>
                            <p class="text-info">Se mostrar&aacute; el Listado de Men&uacute;s por Role</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
