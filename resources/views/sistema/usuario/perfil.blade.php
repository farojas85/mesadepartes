@extends('layouts.master')

@section('contenido-cabecera')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-id-card-alt"></i> Mi Perfil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Mi Perfil</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            @if($usuario->foto=='user_varon.png'|| $usuario->foto=='user_mujer.png')
                <img class="profile-user-img img-fluid img-circle" src="images/{{ $usuario->foto }}" >
            @else
                @php
                    $foto = explode(".",\Auth::user()->foto);
                @endphp
                <img class="profile-user-img img-fluid img-circle" src="/storage/usuario/{{ $foto[0] }}/{{$usuario->foto}}" >
            @endif
            {{-- <img class="profile-user-img img-fluid img-circle"
                 src="images/{{ $usuario->foto }}"
                 alt="User profile picture"> --}}
          </div>

          <h3 class="profile-username text-center">{{ $usuario->persona->nombres.' '.$usuario->persona->apellido_paterno.' '.$usuario->persona->apellido_materno }}</h3>

          <p class="text-muted text-center">{{ $usuario->role->nombre }}</p>
          <p class="text-muted text-center font-weight-bold">{{ $usuario->area->nombre }}</p>
          <p class="text-muted text-center">{{ $usuario->cargo->nombre }}</p>

        {{-- <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Followers</b> <a class="float-right">1,322</a>
            </li>
            <li class="list-group-item">
              <b>Following</b> <a class="float-right">543</a>
            </li>
            <li class="list-group-item">
              <b>Friends</b> <a class="float-right">13,287</a>
            </li>
          </ul> --}}

            <button class="btn btn-primary btn-block" onclick="mdlSubirFoto({{ $usuario->id }})">
                <i class="fas fa-cloud-upload-alt"></i> Subir foto
            </button>
            <button class="btn bg-pink btn-block" onclick="mdlCambiarContrasena({{ $usuario->id }})">
                <i class="fas fa-key"></i> Cambiar Contraseña
            </button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#dato-personal" data-toggle="tab">Datos Personales</a></li>
            <li class="nav-item"><a class="nav-link" href="#dato-usuario" data-toggle="tab">Datos Usuario</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="dato-personal">
                @include('sistema.usuario.mostrarDatoPersona')
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="dato-usuario">
               @include('sistema.usuario.mostrarDatoUsuario')
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection

@section('scripts')
<script src="scripts/perfil.js"></script>
@endsection
