<form method="POST" action="{{ route('documento-tramites.store') }}" id="form-documento-tramite">
    @csrf
    @include('configuracion.documento_tramite.form')
</form>
