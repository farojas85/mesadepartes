<form action="{{ route('usuarios.guardar-foto') }}" method="POST" id="form-guardar-foto">
    @csrf
    <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario->id }}">
    <div class="row">
        <div class="col-md-12">
            <input type="file" class="form-control subir-archivo" id="foto" name="foto">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" onclick="guardarFoto(event)">
            <i class="fas fa-cloud-upload-alt"></i> guardar Imagen
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i> Cancelar
        </button>
    </div>
</form>
