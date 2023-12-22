@extends('templete.templete')

@section('import_vite')
@vite([
        'resources/js/importVue.js',
     ])
@endsection

@section('contenido')
<!-- Content Column -->
<div class="col-lg-12 mb-4">
    
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubicacion de Clientes <i class="fas fa-map-marked-alt"></i></h6>
        </div>
        <div class="card-body">
            <div id="mapaClientes"></div>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Clientes <i class="fas fa-map-marked-alt"></i></h6>
        </div>
        <div class="card-body">
            <div id="mapaClientes"></div>
        </div>
    </div>
@endsection