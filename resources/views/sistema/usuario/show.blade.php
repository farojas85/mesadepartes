<div class="row">
    <div class="col-md-6">
        <div class="card card-maroon">
            <div class="card-header">
                <h3 class="card-title">Datos Personales</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Tipo Docum.</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Tipo Documento">
                            <option value="">-Seleccionar-</option>
                        @forelse ($tipoDocumentos as $tipo)
                            <option value="{{ $tipo->id }}"
                                @if($tipo->id == $persona->tipodocumento_id)
                                selected
                                @endif
                                >{{ $tipo->nombre }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
               <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nro. Docum.</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Ingrese Nro. Documento"
                            value="{{ $persona->numero_documento }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nombres</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nombres" name ='nombres'
                            placeholder="Ingrese Nombres Completos" value="{{ $persona->nombres }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Ap. Paterno</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="apellido_paterno" name ='apellido_paterno'
                            placeholder="Ingrese Apellido Paterno" value="{{ $persona->apellido_paterno }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Ap. Materno</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="apellido_materno" name ='apellido_materno'
                            placeholder="Ingrese Apellido Materno" value="{{ $persona->apellido_materno }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Correo Per.</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="correo_personal" name ='correo_personal'
                            placeholder="Ingrese Correo Elec." value="{{ $persona->correo_personal }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Telf. Celular</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="telefono_celular" name ='telefono_celular'
                            value="{{ $persona->telefono_celular }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Telf. Fijo</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="telefono_fijo" name ='telefono_fijo'
                           value="{{ $persona->telefono_fijo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Sexo</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Sexo" id="sexo" name="sexo">
                            <option value="">-Seleccionar-</option>
                        @forelse ($sexos as $sexo)
                            <option value="{{ $sexo['id'] }}"
                            @if ($sexo['id'] == $persona->sexo)
                                selected
                            @endif
                            >{{ $sexo['nombre'] }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Datos De Acceso</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Usuario Code.</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="usuario_codigo" name ='usuario_codigo'
                            placeholder="Ingrese Usuario Código" value="{{ $usuario->usuario_codigo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Usuario Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="usuario_email" name ='usuario_email'
                            value="{{ $usuario->usuario_email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nro. Celular</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="numero_celular" name ='numero_celular'
                            value="{{ $usuario->numero_celular }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nro. Anexo</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="numero_anexo" name ='numero_anexo'
                            value="{{ $usuario->numero_anexo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">&Aacute;rea</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Area" id="area_id" name="area_id" >
                            <option value="">-Seleccionar-</option>
                        @forelse ($areas as $area)
                            <option value="{{ $area->id }}"
                                @if ($area->id == $usuario->area_id)
                                selected
                                @endif>{{ $area->nombre }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Cargo</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Cargo" id="cargo_id" name="cargo_id">
                            <option value="">-Seleccionar-</option>
                        @forelse ($cargos as $cargo)
                            <option value="{{ $cargo->id }}"
                                @if ($cargo->id == $usuario->cargo_id)
                                    selected
                                @endif>{{ $cargo->nombre }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Rol</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Rol Usuario" id="role_id" name="role_id">
                            <option value="">-Seleccionar-</option>
                        @forelse ($roles as $role)
                            <option value="{{ $role->id }}"
                                @if ($role->id == $usuario->role_id)
                                selected
                                @endif>{{ $role->nombre }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
        </button>&nbsp;
    </div>
</div>

