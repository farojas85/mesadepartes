<form method="PUT" action="{{ route('menus.update',$menu) }}" id="form-menu">
    @csrf
    @include('sistema.menu.form')
</form>
