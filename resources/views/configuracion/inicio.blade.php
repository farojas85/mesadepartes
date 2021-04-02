@extends('layouts.master')

@section('contenido-cabecera')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-cogs"></i> Configuraci&oacute;n</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Configuraci&oacute;n</li>>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-purple card-outline">
            <div class="card-header p-0 pt-1">
                <button type="button" class="btn btn-app bg-purple"
                    onclick="cambiarVista('areas')">
                    <i class="fas fa-id-card-alt"></i> &Aacute;reas
                </button>
                <button type="button" class="btn btn-app bg-purple"
                    onclick="cambiarVista('cargos')">
                    <i class="fas fa-id-card-alt"></i> Cargos
                </button>
                <button type="button" class="btn btn-app bg-purple"
                    onclick="cambiarVista('tipodocumentos')">
                    <i class="fab fa-dochub"></i> Tipo Doc.
                </button>
                <button type="button" class="btn btn-app bg-purple"
                    onclick="cambiarVista('documento-tramites')">
                    <i class="fab fa-dochub"></i> Doc. Trám.
                </button>
                <button type="button" class="btn btn-app bg-purple"
                    onclick="cambiarVista('tipo-tramite')">
                    <i class="fab fa-dochub"></i> Tip. Trám.
                </button>
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
<script src="scripts/configuracion.js"></script>
@endsection
