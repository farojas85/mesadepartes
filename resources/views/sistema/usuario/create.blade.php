<form method="POST" action="{{ route('usuarios.store') }}" id="form-usuario">
    @csrf
    @include('sistema.usuario.form')
</form>
