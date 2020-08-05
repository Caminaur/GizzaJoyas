@extends('layouts.plantilla')
@section('titulo')
Perfil
@endsection
@section('main')


    <ul class="uk-breadcrumb px-4 py-2">
      <li><a href="/">Inicio</a></li>
      <li><span class="dandelion">Tu Perfil</span></li>
    </ul>

    <div class="container">

      {{-- <h2 class="regular text-center pb-3">Datos de tu <span class="bold blueSlate">Perfil</span></h2>
      <br>
        <li>Tu Nombre es: {{ Auth::user()->name }}</li>
        <br>
        <li>Tu Email es: {{ Auth::user()->email }}</li>
        <br>
        <a class="btn border-ashBlue" href="/editar-perfil">Editar Perfil</a> --}}

        <table class="uk-table uk-table-small uk-table-divider">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th class="uk-width-small"></th>
            <th class="uk-width-small"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ Auth::user()->name }}</td>
            <td>{{ Auth::user()->email }}</td>
            <td><a class="btn border-ashBlue" href="/editar-perfil">Editar Perfil</a></td>
            <td><a class="btn border-dandelion" href="/editar-perfil">Eliminar Perfil</a></td>
        </tr>
    </tbody>
</table>

    </div>



@endsection
