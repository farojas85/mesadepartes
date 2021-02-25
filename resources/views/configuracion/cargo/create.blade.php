<form method="POST" action="{{ route('cargos.store') }}" id="form-cargo">
    @csrf
    @include('configuracion.cargo.form')
</form>
