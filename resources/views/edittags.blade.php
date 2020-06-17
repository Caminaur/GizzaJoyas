@extends('layouts.plantilla')
@section('titulo')
Edit Tags
@endsection
@section('main')
<div class="container">
  <h5 class="centrado titulo">Agregar / Editar Tags</h5>

  @foreach ($tags as $tag)
      <form class="form-signup" action='/edittag' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @method('put')
          <div class="form-group">
            <label for="">Nombre: </label>
            <input type="text" hidden name="tag_id" value="{{$tag->id}}">
            <input type="text" class="form-control" name="name" value="{{$tag->name}}">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <button class="enviar" type="submit" name="button">Editar Tag</button>
      </form>

      <form class="" action="/deletetag" method="post">
        {{csrf_field()}}
        <input type="text" hidden name="tag_id" value="{{$tag->id}}">
        <button class="eliminar" type="submit" name="button">Eliminar Tag</button>
      </form>
  @endforeach
  <h5 class="centrado titulo">Agregar tag</h5>
  <form class="form-signup" action='/addTag' method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" name="name" placeholder="Nombre del tag" value="">
        @error('name')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <button class="enviar" type="submit" name="button">Agregar Tag</button>
  </form>

</div>
@endsection
