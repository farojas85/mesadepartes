<form method="PUT" action="{{ route('documento-tramites.update',$documentoTramite) }}" id="form-documento-tramite">
    @csrf
    @include('configuracion.documento_tramite.form')
</form>
