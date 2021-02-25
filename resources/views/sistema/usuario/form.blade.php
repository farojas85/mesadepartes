<div class="row">
    <div class="col-md-6">
        <div class="card card-maroon">
            <div class="card-header">
                <h3 class="card-title">Datos Personales</h3>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" id="id"
                @if($estadoCrud == 'editar') value="{{ $usuario->id }}" @endif>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Tipo Docum.</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Tipo Documento" id="tipo_documento_id" name="tipo_documento_id">
                            <option value="">-Seleccionar-</option>
                        @forelse ($tipoDocumentos as $tipo)
                            <option value="{{ $tipo->id }}"
                                @if ($estadoCrud=='editar' && $tipo->id == $usuario->tipo_documento_id)
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
                        <input type="text" class="form-control" id="numero_documento" name ='numero_documento'
                            placeholder="Ingrese Nro. Documento" onkeyup="verificarNumeroDoumento()"
                            @if($estadoCrud == 'editar') value="{{ $usuario->numero_documento }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nombres</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nombres" name ='nombres'
                            placeholder="Ingrese Nombres Completos"
                            @if($estadoCrud == 'editar') value="{{ $usuario->nombres }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Ap. Paterno</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="apellido_paterno" name ='apellido_paterno'
                            placeholder="Ingrese Apellido Paterno"
                            @if($estadoCrud == 'editar') value="{{ $usuario->apellido_paterno }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Ap. Materno</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="apellido_materno" name ='apellido_materno'
                            placeholder="Ingrese Apellido Materno"
                            @if($estadoCrud == 'editar') value="{{ $usuario->apellido_materno }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Correo Per.</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="correo_personal" name ='correo_personal'
                            placeholder="Ingrese Correo Elec."
                            @if($estadoCrud == 'editar') value="{{ $usuario->correo_personal }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Telf. Celular</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="telefono_celular" name ='telefono_celular'
                            placeholder="Ingrese 9 Dígitos"
                            @if($estadoCrud == 'editar') value="{{ $usuario->telefono_celular }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Telf. Fijo</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="telefono_fijo" name ='telefono_fijo'
                            placeholder="Ingrese 6 Dígitos"
                            @if($estadoCrud == 'editar') value="{{ $usuario->telefono_fijo }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Sexo</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Sexo" id="sexo" name="sexo">
                            <option value="">-Seleccionar-</option>
                        @forelse ($sexos as $sexo)
                            <option value="{{ $sexo['id'] }}"
                            @if ($estadoCrud=='editar' && $sexo['id'] == $usuario->sexo)
                            selected
                            @endif>{{ $sexo['nombre'] }}</option>
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
                            placeholder="Ingrese Usuario Código"
                            @if($estadoCrud == 'editar') value="{{ $usuario->usuario_codigo }}" @endif readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Usuario Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="usuario_email" name ='usuario_email'
                            placeholder="Ingrese Email de Usuario"
                            @if($estadoCrud == 'editar') value="{{ $usuario->usuario_email }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nro. Celular</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="numero_celular" name ='numero_celular'
                            placeholder="Ingrese Nro. de Celular"
                            @if($estadoCrud == 'editar') value="{{ $usuario->numero_celular }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Nro. Anexo</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="numero_anexo" name ='numero_anexo'
                            placeholder="Ingrese Nro. de Anexo"
                            @if($estadoCrud == 'editar') value="{{ $usuario->nnumero_anexo }}" @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Cargo</label>
                    <div class="col-md-9">
                        <select class="form-control" title="Cargo" id="cargo_id" name="cargo_id">
                            <option value="">-Seleccionar-</option>
                        @forelse ($cargos as $cargo)
                            <option value="{{ $cargo->id }}"
                                @if ($estadoCrud=='editar' && $cargo->id == $usuario->cargo_id)
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
                                @if ($estadoCrud=='editar' && $role->id == $usuario->role_id)
                                selected
                                @endif>{{ $role->nombre }}</option>
                        @empty
                            <option value="0">--Configurar--</option>
                        @endforelse
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label for="nombre" class="col-form-label col-md-3">Foto</label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" id="foto" name ='foto'
                            placeholder="">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
        </button>&nbsp;
        <button type="submit" class="btn btn-success" onclick="guardarUsuario(event)"
            value="{{ $estadoCrud }}">
            @if($estadoCrud=='nuevo')
            <i class="fas fa-save"></i> Guardar
            @else
            <i class="fas fa-retweet"></i> Modificar
            @endif
        </button>

    </div>
</div>

