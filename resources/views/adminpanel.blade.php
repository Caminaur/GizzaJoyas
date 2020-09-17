@extends('layouts.plantilla')
@section('titulo')
Panel de Control
@endsection
@section('main')

  <div class="container text-center my-4">

    <div class="controles">

      <div class="row">
        <div class="col-12">
          <a class="d-block control" href="#" uk-toggle="target: .hidden-control; animation:  uk-animation-slide-left, uk-animation-slide-right; duration:400;">Productos</a>
        </div>
      </div>

      <div class="row hidden-control" hidden>
        <div class="col-6">
          <a class="d-block hidden-control control" href="/addproduct" hidden>Agregar Producto</a>
        </div>
        <div class="col-6">
          <a class="d-block hidden-control control" href="/productos" hidden>Editar Producto</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editbrands">Marcas</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editcategory">Categorias</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editmaterials">Materiales</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editgenders">Géneros</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/edittags">Etiquetas</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editpreguntas">Preguntas Frecuentes</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <a class="d-block control" href="#envio" uk-toggle>Envío</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/editcolors">Colores</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/exportexcel">Exportar Productos</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="d-block control" href="/pricecontroller">Ajustar Precios</a>
        </div>

        <!-- Modal envios -->
        @include('partials.envio')
      </div>

    </div>

  </div>

@endsection
