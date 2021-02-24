<form method="POST" action="{{ route('roles.store') }}" id="form-role">
    @csrf
    @include('sistema.role.form')
</form>
