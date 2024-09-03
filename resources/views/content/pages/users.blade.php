@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Usuarios')

@section('content')
<h4>Usuarios Registrados</h4>
<!-- Basic Bootstrap Table -->
@role('admin')
<div class="card">
    <div class="table-responsive text-nowrap">
        <a href="{{ route('pages-users-create') }}" type="button" class="btn btn-primary">Añadir Nuevo Usuario</a>
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Creado en:</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          
            @foreach ($users as $user )
             @if ($user->id !== 1)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @if ($user->hasRole('admin'))
                      <a href="{{ route('pages-users-switch-role', $user->id) }}">
                        <span class="badge bg-primary">Admin</span>
                      </a>
                        @else
                        <a href="{{ route('pages-users-switch-role', $user->id) }}">
                        <span class="badge bg-success">User</span>
                      </a>
                      @endif
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td> <a href="{{ route('pages-users-show',$user->id) }}">Editar</a> | <a href="{{ route('pages-users-destroy',$user->id) }}">Borrar</a> </td>
                </tr>
                @endif
            @endforeach
       
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@else
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Acceso Denegado </h4>
  <p>No tienes permisos para acceder a esta pagina</p>
  <hr>
  <p class="mb-0">Si crees que esto es un error, ponte en contacto con el administrador</p>
</div>
@endrole
@endsection
