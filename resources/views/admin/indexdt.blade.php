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
@vite([ 'resources/js/admin_custom.js','resources/js/app.js','resources/sass/app.scss','resources/css/admin_custom.css','resources/js/usuario.js'])
@endsection
@section('title', 'Dashboard')

@section('content_header')
  <div class="card">
    <div class="card-header">
        <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
    </div>
    <div class="card-body">
      <h4 class="card-subtitle"> <i class="fas fa-users-cog"></i> Módulo de Usuarios Auto </h4>
    </div>
  </div>
@stop

@section('content')

      <div class="card">
          {{-- <div class="card-header">Manage Users</div> --}}
          <div class="card-body">
             {{-- {{ $dataTable->table() }} --}}
              {{ $dataTable->table(['class' => 'table table-bordered table-striped no-footer table-sm', 'style' => 'width: 100%' ]) }}
          </div>
      </div>
@stop


@section('js')
    {{  $dataTable->scripts() }}
@endsection
