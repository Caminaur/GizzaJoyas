@extends('layouts.plantilla')
@section('titulo')
Edit materials
@endsection
@section('main')
<div class="container">
  <h5 class="centrado titulo">Agregar / Editar Materiales</h5>

  @foreach ($materials as $material)
      <form class="form-signup" action='/editmaterial' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @method('put')
          <div class="form-group">
            <label for="">Nombre: </label>
            <input type="text" hidden name="material_id" value="{{$material->id}}">
            <input type="text" class="form-control" name="name" value="{{$material->name}}">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <button class="enviar" type="submit" name="button">Editar material</button>
      </form>

      <form class="" action="/deletematerial" method="post">
        {{csrf_field()}}
        <input type="text" hidden name="material_id" value="{{$material->id}}">
        <button class="eliminar" type="submit" name="button">Eliminar material</button>
      </form>
  @endforeach
  <h5 class="centrado titulo">Agregar material</h5>
  <form class="form-signup" action='/addmaterial' method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" name="name" placeholder="Nombre de la material" value="">
        @error('name')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <button class="enviar" type="submit" name="button">Agregar material</button>
  </form>

</div>
@endsection
