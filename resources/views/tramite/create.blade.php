<form method="POST" action="{{ route('tramite.store') }}" id="form-tramite">
    @csrf
    @include('tramite.form')
</form>
