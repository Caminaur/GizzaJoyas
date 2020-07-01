@extends('layouts.plantilla')
@section('titulo')
Panel de Control
@endsection
@section('main')

  <div class="container text-center">

    <div class="controles">

      <a class="control" href="/addproduct">Agregar Producto</a>
      <a class="control" href="/searchproduct">Editar Producto</a>
      <a class="control" href="/editbrands">Agregar / Editar Marca</a>
      <a class="control" href="/editcategory">Agregar / Editar Categoria</a>
      <a class="control" href="/editcolors">Agregar / Editar Colores</a>
      <a class="control" href="/editmaterials">Agregar / Editar Material</a>
      <a class="control" href="/editgenders">Agregar / Editar Genero</a>
      <a class="control" href="/edittags">Agregar / Editar Tag</a>
      <a class="control" href="/edittags">Agregar / Editar Preguntas Frecuentes</a>

    </div>

  </div>

@endsection
