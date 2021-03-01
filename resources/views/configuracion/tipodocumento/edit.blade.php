<form method="PUT" action="{{ route('tipodocumentos.update',$tipodocumento) }}" id="form-tipodocumento">
    @csrf
    @include('configuracion.tipodocumento.form')
</form>
