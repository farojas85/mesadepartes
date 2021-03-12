<form id="form-editar-dato-usuario" action="{{ route('usuarios.actualizar-dato-usuario') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nombre Usuario</label>
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
            class="form-control form-control-sm" placeholder="Ingrese Número Celular Corporativo">
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Nro. Anexo</label>
        <div class="col-md-4">
            <input type="text" name="numero_anexo" id="numero_anexo" value="{{ $usuario->numero_anexo }}"
            class="form-control form-control-sm" placeholder="Ingrese su número de Anexo">
        </div>
    </div>
    {{-- <div class="form-group row">
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Cargo</label>
        <div class="col-md-4">
            <select class="form-control form-control-sm" id="cargo_id" name="cargo_id">
                <option value="">-Seleccionar-</option>
                @foreach($cargos as $cargo)
                <option value="{{ $cargo->id }}"
                    {{ ($cargo->id == $usuario->cargo_id) ? 'selected' : ''  }}>{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <label for="" class="col-md-2 col-form-label col-form-label-sm">Rol</label>
        <div class="col-md-4">
            <select class="form-control form-control-sm" id="role_id" name="role_id">
                <option value="">-Seleccionar-</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}"
                    {{ ($role->id == $usuario->role_id) ? 'selected' : ''  }}>{{ $role->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}
    <div class="text-center">
        <button type="submit" class="btn bg-success btn-xl btn-modificar-password"
            title="Actualizar" onclick="modificarDatoUsuario(event)">
            <i class="fas fa-key"></i> Actualizar
        </button>
        <button type="button" class="btn bg-danger"
        title="Actualizar" onclick="mdlMostrarDatoUsuario({{ $usuario->id }})">
        <i class="fas fa-times"></i> Cancelar
    </button>
    </div>
</form>
