<form method="POST" action="{{ route('permisos.store') }}" id="form-permiso">
    @csrf
    @include('sistema.permiso.form')
</form>
