@extends('layouts.plantilla')
@section('titulo')
Panel de Control
@endsection
@section('css')
control
@endsection('css')
@section('main')

  <div class="d-flex">

    <div class="controles">
      <div class="">
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/addproduct">Agregar Producto</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/searchproduct">Editar Producto</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/editbrands">Agregar / Editar Marcas</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/editcategory">Buscar categoria</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/editcolors">Agregar / Editar Colores</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/editmaterials">Agregar / Editar Materiales</a>
        <a class="flex-row m-3 px-5 py-4 btn justify-content-center" style="width:80%;" href="/editgenders">Agregar / Editar Genero</a>
      </div>
    </div>

  </div>

@endsection
