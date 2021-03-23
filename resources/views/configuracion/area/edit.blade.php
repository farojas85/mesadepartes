<form method="PUT" action="{{ route('areas.update',$area) }}" id="form-area">
    @csrf
    @include('configuracion.area.form')
</form>
