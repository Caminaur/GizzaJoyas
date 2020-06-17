@extends('layouts.plantilla')
@section('titulo')
Edit brands
@endsection
@section('main')
<div class="container">
  <h5 class="centrado titulo">Agregar / Editar Marcas</h5>

  @foreach ($brands as $brand)
      <form class="form-signup" action='/editbrand' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @method('put')
          <div class="form-group">
            <label for="">Nombre: </label>
            <input type="text" hidden name="brand_id" value="{{$brand->id}}">
            <input type="text" class="form-control" name="name" value="{{$brand->name}}">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <button class="enviar" type="submit" name="button">Editar Marca</button>
      </form>

      <form class="" action="/deletebrand" method="post">
        {{csrf_field()}}
        <input type="text" hidden name="brand_id" value="{{$brand->id}}">
        <button class="eliminar" type="submit" name="button">Eliminar marca</button>
      </form>
  @endforeach
  <h5 class="centrado titulo">Agregar marca</h5>
  <form class="form-signup" action='/addbrand' method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" name="name" placeholder="Nombre de la marca" value="">
        @error('name')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <button class="enviar" type="submit" name="button">Agregar Marca</button>
  </form>

</div>
@endsection
