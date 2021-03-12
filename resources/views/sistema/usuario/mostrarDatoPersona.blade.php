<form id="form-personal-perfil">
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Tipo Documento</label>
        <div class="col-md-4">
            <input type="text" name="role_id" id="role_id" value="{{ $usuario->persona->tipodocumento->nombre }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nro. Documento</label>
        <div class="col-md-4">
            <input type="text" name="numero_documento" id="numero_documento" value="{{ $usuario->persona->numero_documento }}"
                class="form-control form-control-sm" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Apellido Paterno</label>
        <div class="col-md-4">
            <input type="text" name="apellido_paterno" id="apellido_paterno" value="{{ $usuario->persona->apellido_paterno }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Apellido Materno</label>
        <div class="col-md-4">
            <input type="text" name="apellido_materno" id="apellido_materno" value="{{ $usuario->persona->apellido_materno }}"
                class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nombres</label>
        <div class="col-md-4">
            <input type="text" name="nombres" id="nombres" value="{{ $usuario->persona->nombres }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Correo Personal</label>
        <div class="col-md-4">
            <input type="text" name="correo_personal" id="correo_personal" value="{{ $usuario->persona->correo_personal }}"
                class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Telf. Fijo</label>
        <div class="col-md-4">
            <input type="text" name="telefono_fijo" id="telefono_fijo" value="{{ $usuario->persona->telefono_fijo }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Telf. Celular</label>
        <div class="col-md-4">
            <input type="text" name="telefono_celular" id="telefono_celular" value="{{ $usuario->persona->telefono_celular }}"
                class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Sexo</label>
        <div class="col-md-4">
            <input type="text" name="sexo" id="sexo" value="{{ ($usuario->persona->sexo == 'M') ? 'Masculino' : 'Femenino' }}"
            class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="text-center">
        <button type="button" class="btn bg-danger btn-xl btn-modificar-password"
            title="Editar Datos Personales" onclick="mdlEditarDatoPersonal({{ $usuario->id }})">
            <i class="fas fa-edit"></i> Editar
        </button>
    </div>
</form>
