@extends('layouts.plantilla')
@section('titulo')
Edit brands
@endsection
@section('main')

  <!-- Vista de editar marca -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Editar Marca</span></li>
  </ul>

  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Agregar una <span class="bold blueSlate">Marca</span></h2>

      <form class="form-signup" action='/addbrand' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
            <input type="text" class="form-control-checkout" name="name" placeholder="Nombre de la Marca" value="">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
            <button class="btn bg-blueSlate" type="submit" name="button">Agregar Marca</button>
          </div>
      </form>

      <h2 class="regular text-center pb-3">Editar una <span class="bold blueSlate">Marca</span></h2>

      @foreach ($brands as $brand)
        <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
          <form class="p-4" action='/editbrand' method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('put')
              <div class="form-group">
                <input class="form-control-checkout" type="text" hidden name="brand_id" value="{{$brand->id}}">
                <input class="form-control-checkout" type="text" class="form-control" name="name" value="{{$brand->name}}">
                @error('name')
                  <p class="errorForm">{{ $message }}</p>
                @enderror
              </div>
              <button class="btn bg-ashBlue" type="submit" name="button">Editar</button>
          </form>

          <form class="" action="/deletebrand" method="post">
            {{csrf_field()}}
            <input class="form-control-checkout" type="text" hidden name="brand_id" value="{{$brand->id}}">
            <a class="btn bg-dandelion"  href="#confirm" uk-toggle>Eliminar</a>
          </form>
        </div>
      @endforeach

@endsection
