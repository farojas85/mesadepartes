<form method="PUT" action="{{ route('cargos.update',$cargo) }}" id="form-cargo">
    @csrf
    @include('configuracion.cargo.form')
</form>
