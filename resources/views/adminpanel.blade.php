@extends('layouts.plantilla')
@section('titulo')
Panel de Control
@endsection
@section('css')
control
@endsection('css')
@section('main')

  <div class="container text-center">

    <div class="controles">
        <a class="control" href="/addproduct">Agregar Producto</a>
        <a class="control" href="/searchproduct">Editar Producto</a>
        <a class="control" href="/editbrands">Agregar / Editar Marcas</a>
        <a class="control" href="/editcategory">Buscar categoria</a>
        <a class="control" href="/editcolors">Agregar / Editar Colores</a>
        <a class="control" href="/editmaterials">Agregar / Editar Materiales</a>
        <a class="control" href="/editgenders">Agregar / Editar Genero</a>
        <a class="control" href="/edittags">Agregar / Editar Tags</a>
    </div>

  </div>

@endsection
