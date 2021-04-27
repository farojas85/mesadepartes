@extends('layouts.master')

@section('contenido-cabecera')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fab fa-windows"></i> Sistema</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Sistema</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-primary card-outline">
            <div class="card-header p-0 pt-1">
                @puede('roles.inicio')
                <button type="button" class="btn btn-app bg-primary"
                    onclick="cambiarVista('roles')">
                    <i class="fas fa-user-tag"></i> Roles
                </button>
                @endpuede
                @puede('usuarios.inicio')
                <button type="button" class="btn btn-app bg-primary"
                    onclick="cambiarVista('usuarios')">
                    <i class="fas fa-users"></i> Usuarios
                </button>
                @endpuede
                @puede('permisos.inicio')
                <button type="button" class="btn btn-app bg-primary"
                    onclick="cambiarVista('permisos')">
                    <i class="fas fa-users"></i> Permisos
                </button>
                @endpuede
                @puede('menus.inicio')
                <button type="button" class="btn btn-app bg-primary"
                    onclick="cambiarVista('menus')">
                    <i class="fas fa-users"></i> Men&uacute;s
                </button>
                @endpuede
            </div>
            <div class="card-body">
                <div class="tab-content" id="tab-content">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="scripts/sistema.js"></script>
@endsection
