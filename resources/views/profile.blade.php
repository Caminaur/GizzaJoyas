@extends('layouts.plantilla')
@section('titulo')
Perfil
@endsection
@section('main')
  <div class="container">
    <div class="col-md-4 m-3 p-4">
      <h3>Bienvenido {{ Auth::user()->name }}</h3>
      <li>Tu email es: {{ Auth::user()->email }}</li>
      <a href="/editar-perfil">Editar Perfil</a>
    </div>
  </div>
@endsection
