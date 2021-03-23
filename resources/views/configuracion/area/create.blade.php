<form method="POST" action="{{ route('areas.store') }}" id="form-area">
    @csrf
    @include('configuracion.area.form')
</form>
