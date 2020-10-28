@extends('layouts.plantilla')
@section('titulo')
Add product
@endsection
@section('css')
editcategory
@endsection('css')
@section('main')

    <!-- Vista de Agregar Categoría-->

    <ul class="uk-breadcrumb px-4 pt-2">
      <li><a href="/adminpanel">Volver</a></li>
      <li><span class="dandelion">Agregar Categoría</span></li>
    </ul>

    <div class="container text-center pb-4">

      <h2 class="regular text-center pb-3">Agregar <span class="bold blueSlate">Categoría</span></h2>

      <div class="uk-card uk-card-default uk-card-body uk-margin-small" style="text-align: -webkit-center;">

        <form action="/addcategory" method="post" enctype="multipart/form-data">
          @csrf
          <div class="d-flex flex-column justify-content-center align-items-center">
            <label for="name">Nombre de la categoria:</label>
            <input class="form-control-checkout w-25" type="text" name="category_name" value="">
          </div>

          <div class="d-flex flex-column justify-content-center align-items-center my-5">
            <label for="">Seleccionar imagen de la categoria: *</label>
            <label for="file-upload" class="subir" style="cursor:pointer">
              <i class="fas fa-cloud-upload-alt"></i> Subir imagen
            </label>
            <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="image" value="">
            <small id="emailHelp" class="form-text text-muted">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
            @error('image')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <h3 class="regular text-center pb-3">Agregue los talles de la <span class="bold blueSlate">Categoría</span></h3>
          {{-- En este div vacio se agrega una label y un input cada vez que se clickea el boton de agregar talle --}}
          <button id="addSize" class="offset-md-2 form-group blueSlate" uk-icon="icon: plus-circle; ratio: 4 ;" type="button"></button>
          <div class="my-4" id="divFormSize" class=""></div>

          <button class="btn bg-blueSlate" type="submit" name="button">Crear Categoria</button>
        </form>

      </div>

    </div>


  <script src="/js/addcategory.js" charset="utf-8"></script>
@endsection
