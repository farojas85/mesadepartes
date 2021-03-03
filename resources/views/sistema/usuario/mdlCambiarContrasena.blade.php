<form action="{{ route('usuarios.guardar-contrasena') }}" method="POST" id="form-cambiar-contrasena">
    @csrf
    <input type="hidden" name="usuario_id" id="usuario_id" value="@if($usuario) {{ $usuario->id }} @endif">
    <div class="form-group row">
        <label class="col-form-label col-md-5">Nueva Contrase&ntilde;a</label>
        <div class="col-md-7">
            <input type="password" name="password" id="password" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-md-5">Confirmar Contrase&ntilde;a</label>
        <div class="col-md-7">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-success" onclick="guardarContrasena(event)">
            <i class="fas fa-save"></i> Guardar
        </button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
        </button>
    </div>
</form>
