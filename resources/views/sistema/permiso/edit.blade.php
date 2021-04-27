<form method="PUT" action="{{ route('permisos.update',$permiso) }}" id="form-permiso">
    @csrf
    @include('sistema.permiso.form')
</form>
