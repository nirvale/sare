{{-- @extends('layouts.app')

@slot('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>


@push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}

@extends('adminlte::page')
@section('meta_tags')
  {{  $dataTable->scripts() }}
@vite([ 'resources/js/admin_custom.js','resources/js/app.js','resources/sass/app.scss','resources/css/admin_custom.css','resources/js/dominio.js'])
@endsection
@section('title', 'OFICINAS')

@section('content_header')
  <div class="card">
    <div class="card-header">
        <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
    </div>
    <div class="card-body">
      <h4 class="card-subtitle"> <i class="fas fa-puzzle-piece"></i> Módulo de Catálogos - Oficinas </h4>
    </div>
  </div>
@stop

@section('content')

      <div class="card">
          {{-- <div class="card-header">Manage Users</div> --}}
          <div class="card-body">
              {{ $dataTable->table(['class' => 'table table-bordered table-striped no-footer', 'style' => 'width: 100%' ]) }}
          </div>
      </div>
      <div id="modales" class="modales">
        <div class="modalesEditar">
          {{-- no se requiere en esté modulo --}}
        </div>
        <div class="modalesCrear">

          <x-admin.modal70
            idModal=oficinas
            iconoNombreModal="fas fa-puzzle-piece"
            nombreModal="Agregar Oficina"
          >
            <div class="from-group row col-md-12" id="modalc1">
            </div>
            <div id="printThis"> {{-- zona imprimible--}}


             <div class="from-group row col-md-12" id="modalc2">
             </div>

            </div>{{-- fin zona imprimible--}}
          </x-admin.modal70>

        </div>
      </div>

@include('layouts.footer')
@stop
