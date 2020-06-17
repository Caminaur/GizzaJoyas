@extends('layouts.plantilla')
@section('titulo')
Edit Colors
@endsection
@section('main')
<div class="container">
  <h5 class="centrado titulo">Agregar / Editar Colores</h5>

  @foreach ($colors as $color)
      <form class="form-signup" action='/editcolor' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @method('put')
          <div class="form-group">
            <label for="">Nombre: </label>
            <input type="text" hidden name="color_id" value="{{$color->id}}">
            <input type="text" class="form-control" name="name" value="{{$color->name}}">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <button class="enviar" type="submit" name="button">Editar Color</button>
      </form>

      <form class="" action="/deletecolor" method="post">
        {{csrf_field()}}
        <input type="text" hidden name="color_id" value="{{$color->id}}">
        <button class="eliminar" type="submit" name="button">Eliminar Color</button>
      </form>
  @endforeach
  <h5 class="centrado titulo">Agregar color</h5>
  <form class="form-signup" action='/addcolor' method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" name="name" placeholder="Nombre de la color" value="">
        @error('name')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <button class="enviar" type="submit" name="button">Agregar Color</button>
  </form>

</div>
@endsection
