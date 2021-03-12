<form id="form-personal-perfil">
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">nombre Usuario</label>
        <div class="col-md-4">
            <input type="text" name="usuario_codigo" id="usuario_codigo" value="{{ $usuario->usuario_codigo }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Correo Usuario</label>
        <div class="col-md-4">
            <input type="text" name="usuario_email" id="usuario_email" value="{{ $usuario->usuario_email }}"
                class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nro. Celular</label>
        <div class="col-md-4">
            <input type="text" name="numero_celular" id="numero_celular" value="{{ $usuario->numero_celular }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nro. Anexo</label>
        <div class="col-md-4">
            <input type="text" name="numero_anexo" id="numero_anexo" value="{{ $usuario->numero_anexo }}"
            class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Cargo</label>
        <div class="col-md-4">
            <input type="text" name="cargo_id" id="cargo_id" value="{{ $usuario->cargo->nombre }}"
            class="form-control form-control-sm" readonly>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Rol</label>
        <div class="col-md-4">
            <input type="text" name="role_id" id="role_id" value="{{ $usuario->role->nombre }}"
            class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="text-center">
        <button type="button" class="btn bg-danger btn-xl btn-modificar-password"
            title="Editar Datos Usuarios" onclick="mdlEditarDatoUsuario({{ $usuario->id }})">
            <i class="fas fa-edit"></i> Editar
        </button>
    </div>
</form>
