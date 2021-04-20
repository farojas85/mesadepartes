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
                    <div class="col-md-12 mb-2">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Listado Tr&aacute;mite
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="input-group input-group-sm col-md-2 mb-2">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text text">Mostrar</span>
                                        </div>
                                        <select class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <select  class="form-control form-control-sm" onchange="mostrarFiltroUsuario(this.value)"
                                            id="filtro-role">
                                            <option value="">-Filtro-</option>
                                            <option value="todos">Todos</option>
                                            <option value="habilitados">habilitados</option>
                                            <option value="eliminados">Eliminados</option>
                                        </select>
                                    </div>
                                    <div class="input-group input-group-sm col-md-8 mb-2">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">Buscar</span>
                                        </div>
                                        <input type="text" name="table-search" id="table-search"
                                            class="form-control"  placeholder="Buscar..." onkeyup="buscarUsuario(this.value)">
                                    </div>
                                </div>
                                <div class="row"  id="detalle-tabla">
                                    <div class="col-md-12 mb-1">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered table-hover nowraper">
                                                <thead class="bg-navy">
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center">C&oacute;digo</th>
                                                        <th class="text-center">Fecha</th>
                                                        <th class="text-center">Tramitador</th>
                                                        <th class="text-center">Tipo Documento</th>
                                                        <th class="text-center">Estado</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tramites as $tramite)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration-1 +$tramites->firstItem()  }}</td>
                                                        <td class="text-center">{{ $tramite->codigo_tramite }}</td>
                                                        <td class="text-center">{{ \Carbon\Carbon::parse($tramite->fecha_hora)->format('d/m/Y h:i:s a' ) }}</td>
                                                        <td>
                                                            {{ $tramite->user->persona->nombres.' '.$tramite->user->persona->apellido_paterno.' '.$tramite->user->persona->apellido_materno }}
                                                        </td>
                                                        <td class="text-center">{{ $tramite->tipo_tramite->nombre }}</td>
                                                        <td class="text-center">
                                                            <span class="{{ $tramite->estado_tramite->clase }}">{{ $tramite->estado_tramite->nombre }}</span>
                                                        </td>
                                                    </tr>
                                                    @empty

                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
