@extends('layouts.master')

@section('estilos')
<style>
    .custom-file-input ~ .custom-file-label::after {
        content: "Escoger";
    }
</style>
@endsection
@section('contenido-cabecera')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-file-invoice"></i> Tr&aacute;mite</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Tr&aacute;mite</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-primary card-outline">
            <div class="card-header p-0 pt-1">
                <button type="button" class="btn btn-app bg-danger" onclick="nuevoTramite()">
                    <i class="fas fa-plus"></i> Nuevo Tr&aacute;mite
                </button>
                <button type="button" class="btn btn-app bg-primary"
                    onclick="cambiarVista('usuarios')">
                    <i class="fas fa-users"></i> Usuarios
                </button>
            </div>
            <div class="card-body">
                <div class="tab-content" id="tab-content">
                </div>
            </div>
        </div>
    </div>
</div>

@include('tramite.create')
@endsection

@section('scripts')
<script src="scripts/tramite.js"></script>
@endsection
