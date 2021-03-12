<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mesa de Partes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @auth
                    {{-- <img src="{{ asset('images/'.\Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image"> --}}
                    @if(\Auth::user()->foto=='user_varon.png'|| \Auth::user()->foto=='user_mujer.png')
                        <img src="{{ asset('images/'.\Auth::user()->foto) }}" class="img-size-32 img-circle" alt="User Image">
                        {{-- <img class="profile-user-img img-fluid img-circle" src="images/{{ $user->foto }}" > --}}
                    @else
                        @php
                            $foto = explode(".",\Auth::user()->foto);
                        @endphp
                        <img  class="img-size-32 img-circle" src="/storage/usuario/{{ $foto[0] }}/{{\Auth::user()->foto}}" >
                    @endif
                @else
                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                @endauth
            </div>
            <div class="info">
                @auth
                <a href="#" class="d-block">{{ \Auth::user()->persona->nombres }}</a>
                @else
                <a href="#" class="d-block">Invitado</a>
                @endauth
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar..."
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">MEN&Uacute; NAVEGACI&Oacute;N</li>
                @forelse ($menus as $key => $item)
                    @if ($item["padre_id"]!=null)
                        @break
                    @endif
                    @include('layouts.partials.menu-items',["item" => $item])
                @empty
                @endforelse
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
