<form method="PUT" action="{{ route('tipo-tramite.update',$tipoTramite) }}" id="form-tipo-tramite">
    @csrf
    @include('configuracion.tipotramite.form')
</form>
