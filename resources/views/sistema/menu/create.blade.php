<form method="POST" action="{{ route('menus.store') }}" id="form-menu">
    @csrf
    @include('sistema.menu.form')
</form>
