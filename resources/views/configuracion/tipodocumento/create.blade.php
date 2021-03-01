<form method="POST" action="{{ route('tipodocumentos.store') }}" id="form-tipodocumento">
    @csrf
    @include('configuracion.tipodocumento.form')
</form>
