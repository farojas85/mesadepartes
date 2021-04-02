<form method="POST" action="{{ route('tipo-tramite.store') }}" id="form-tipo-tramite">
    @csrf
    @include('configuracion.tipotramite.form')
</form>
