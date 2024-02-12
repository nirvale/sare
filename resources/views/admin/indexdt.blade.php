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

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class="container">
      <div class="card">
          <div class="card-header">Manage Users</div>
          <div class="card-body">
              {{ $dataTable->table() }}
          </div>
      </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
 @stack('scripts')
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
