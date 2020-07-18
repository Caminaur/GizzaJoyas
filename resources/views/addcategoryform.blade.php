@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('css')
editcategory
@endsection('css')
@section('main')
  <div class="container">
    <h2>Agregar categoria</h2>
    <form class="" action="/addcategory" method="post" enctype="multipart/form-data">
      @csrf
      <div class="col-md-4 p-0 form-group">
        <label for="name">Nombre de la categoria:</label>
        <input type="text" name="category_name" value="">
      </div>

      <label for="">Seleccionar imagen de la categoria: *</label>
      <div class="col-lg-8 form-group">
        <label for="file-upload" class="subir">
          <i class="fas fa-cloud-upload-alt"></i> Subir imagen
        </label>
        <br>
        <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="image" value="">
        @error('image')
          <p class="errorForm">{{ $message }}</p>
        @enderror
      </div>
      <small id="emailHelp" class="form-text text-muted">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>

      <h2>Agregue los talles de la categoria</h2>
      {{-- En este div vacio se agrega una label y un input cada vez que se clickea el boton de agregar talle --}}
      <div class="container" id="divFormSize" class=""></div>
      <button id="addSize" class="offset-md-2 form-group" type="button" name="">Agregar talle</button>

      <button class="col-md-2 offset-md-1" type="submit" name="button">Crear Categoria</button>
    </form>
  </div>
  <script src="/js/addcategory.js" charset="utf-8"></script>
@endsection
