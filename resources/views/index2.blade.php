@extends('templete.templete')

@section('import_vite')
@vite(['resources/js/importVue.js'])
@endsection

@section('contenido')
<!-- Content Column -->
<div class="col-lg-6 mb-4">
    
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de nuevo cliente <i class="fas fa-users"></i></h6>
        </div>
        <div class="card-body">
            <div id="app"></div>
        </div>
    </div>    
@endsection
