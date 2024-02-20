@extends('adminlte::page')
@section('title', 'Usuarios')
@section('meta_tags')
@vite([ 'resources/js/admin_custom.js','resources/js/app.js','resources/sass/app.scss','resources/css/admin_custom.css','resources/js/usuario.js'])
@endsection
@section('content_header')
  <x-admin.main-card

      iconoTituloTarjeta="fas fa-hat-wizard"
      tituloTarjeta="Sistema de Administración para Recursos Estratégicos - DGTG"
      iconoNombreMoudulo="fas fa-users-cog"
      nombreModulo="Módulo de Usuarios"
  >
</x-admin.main-card>

@stop

@section('content')
{{-- Creando los botones --}}
<x-admin.card-general cardID="cardBotones">
  <p>
       <a href="" type="button" id="consultaUsuarios" class="btn btn-secondary" >CONSULTAR USUARIOS <i class="fas fa-user-check"></i></a>
       <a href="" type="button" id="agregarUsuario" class="btn btn-success" >AGREGAR USUARIO <i class="fas fa-user-plus"></i></a>
  </p>
</x-admin.card-general>
{{-- Fin Creando los botones --}}
{{-- Creando la tabla --}}
<x-admin.card-general cardID="cardDatatables"  >
  <x-admin.head-datatables  nombreDataTable="Usuarios"  >
        {{-- <th data-name='matricula'>Nombre</th> --}}
        <th>ID</th>
        {{-- <th>RFC</th> --}}
        <th>NOMBRE</th>
        <th>OFICINA</th>
        <th>PERFIL</th>
        <th>ESTADO</th>
        <th>ACCIÓN</th>
        {{-- <th>Acción</th> --}}
  </x-admin.head-datatables>
</x-admin.card-general>
{{-- Fin Creando la tabla --}}
  {{-- editar/Crear usuario  --}}
<x-admin.modal70
  idModal=usuario
  iconoNombreModal="fas fa-user-plus"
  nombreModal="Agregar Usuario"
>
    <div class="from-group row col-md-12" id="modalc1">
    </div>
    <div id="printThis"> {{-- zona imprimible--}}


       <div class="from-group row col-md-12" id="modalc2">
       </div>

    </div>{{-- fin zona imprimible--}}
</x-admin.modal70>

{{-- fin editar/crear usuario --}}



@include('layouts.footer')

@stop
