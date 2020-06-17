@extends('layouts.plantilla')
@section('titulo')
Edit Gender
@endsection
@section('main')
<div class="container">
  <h5 class="centrado titulo">Agregar / Editar Gender</h5>

  @foreach ($genders as $gender)
      <form class="form-signup" action='/editgender' method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @method('put')
          <div class="form-group">
            <label for="">Nombre: </label>
            <input type="text" hidden name="gender_id" value="{{$gender->id}}">
            <input type="text" class="form-control" name="name" value="{{$gender->name}}">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <button class="enviar" type="submit" name="button">Editar género</button>
      </form>

      <form class="" action="/deletegender" method="post">
        {{csrf_field()}}
        <input type="text" hidden name="gender_id" value="{{$gender->id}}">
        <button class="eliminar" type="submit" name="button">Eliminar género</button>
      </form>
  @endforeach
  <h5 class="centrado titulo">Agregar género</h5>
  <form class="form-signup" action='/addgender' method="post" enctype="multipart/form-data">
    {{csrf_field()}}
      <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" name="name" placeholder="Nombre de la género" value="">
        @error('name')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <button class="enviar" type="submit" name="button">Agregar Género</button>
  </form>

</div>
@endsection
