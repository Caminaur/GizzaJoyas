@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('css')
editcategory
@endsection('css')
@section('main')

  <!-- Vista de Editar Categoría-->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Editar Categoría</span></li>
  </ul>


  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Editar <span class="bold blueSlate">Categoría</span></h2>

    <div class="uk-card uk-card-default uk-card-body uk-margin-small" style="text-align: -webkit-center;">

      <form action="/changeName" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="d-flex flex-column justify-content-center align-items-center">
          <label for="category_id">Nombre de la Categoría: *</label>
          <input class="form-control-checkout w-25" type="text" name="category_name" value="{{$category->name}}">
          <input type="hidden" name="category_id" value="{{$category->id}}">
        </div>
        <button class="btn bg-blueSlate" type="submit" name="button">Editar</button>
      </form>

      <br>

      <h3 class="regular text-center pb-3">Imagen de la <span class="bold blueSlate">Categoría</span></h3>

      <div class="col-md-4 mt-2 form-group">
        <img src="/storage/{{$category->image}}" alt="">
      </div>


      <form class="" action="/changeCategoryImage" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="justify-content-center">
          <label for="file-upload" class="subir">
            <i class="fas fa-cloud-upload-alt"></i> Cambiar imagen
          </label>
          <br>
          <input type="hidden" name="categoryId" value="{{$category->id}}">
          <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="image" value="">
          <div id="info"></div>
          @error('image')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>
        <small id="emailHelp" class="form-text text-muted">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
        <button class="btn bg-blueSlate" type="submit" name="button">Editar</button>
      </form>
    </div>

    <br><br>

    <div class="uk-card uk-card-default uk-card-body uk-margin-small">

      <h3 class="regular text-center pb-3">Tags relacionados con esta <span class="bold blueSlate">Categoría</span></h3>

        <div class="row">
        @foreach ($category->tags as $tag)
          <div class="col my-5">
            <form class="d-flex flex-column" action="/deleteCategoryTag" method="post">
              <label for="">{{$tag->name}}</label>
              @csrf
              <input type="hidden" name="tagId" value="{{$tag->id}}">
              <input type="hidden" name="categoryId" value="{{$category->id}}">
              <button class="btn bg-dandelion" type="submit" name="">Eliminar</button>
            </form>
          </div>
          <br>
        @endforeach
      </div>

      <div class="my-3">
        <label for="">Agregar Tag existente</label>
        <br>
        <a class="blueSlate hvr-shrink" id="addTag" uk-icon="icon: plus-circle; ratio: 4 ;"></a>
        <br>
      </div>

      <div class="" hidden id="addTagId" class="">
        <form class="d-flex flex-column align-items-center my-4" action="/selecttag" method="post">
          @csrf
          <label for="">Tags </label>
          <select class="form-control-checkout w-25" name="tagId">
            <option value="">Seleccione un tag a agregar</option>
            @php
            $tags_db = [];
            // traemos todos los tags relacionados a esta categoría
            foreach ($category->tags as $tag_db) {
              // Los almacenamos en un array
              $tags_db[] = $tag_db->name;
            }
            // Traemos la totalidad de los tags
            foreach ($tags as $tag) {
              $tags_todos[] = $tag;
            }
            @endphp
            @foreach ($tags_todos as $tag)
              @if (!in_array($tag->name,$tags_db))
                <option value="{{$tag->id}}">{{$tag->name}}</option>
              @endif
            @endforeach
          </select>
          <input type="hidden" name="category_id" value="{{$category->id}}">
          <button class="btn bg-blueSlate" type="submit" name="">Agregar</button>
          <button class="btn bg-ashBlue"type="button" id="btnHide" name="button">Ocultar</button>
        </form>
      </div>

      <div id="createTagDiv" hidden class="">
        <form class="d-flex flex-column align-items-center my-5" action="/createtag" method="post">
          @csrf
          <label for="name">Nombre</label>
          <input type="text" id="name" name="name" value="">
          <input type="hidden" name="category_id" value="{{$category->id}}">
          <button class="btn bg-blueSlate" type="submit">Crear Tag</button>
          <button class="btn bg-ashBlue" type="button" id="hideCreateTag">Ocultar</button>
        </form>
      </div>

      <div class="my-3">
        <label for="">Crear un nuevo Tag para {{$category->name}}</label>
        <br>
        <a class="blueSlate hvr-shrink" id="createTag" uk-icon="icon: plus-circle; ratio: 4 ;"></a>
      </div>
    </div>

    <br><br>

    <div class="uk-card uk-card-default uk-card-body uk-margin-small">

      <h3 class="regular text-center pb-3">Talles de la <span class="bold blueSlate">Categoría</span></h3>

      <div class="row mt-3 justify-content-center">
        @foreach ($sizes as $size)
            <div class="col-6 col-lg-4 mt-2 justify-content-center">
                <form class="d-flex flex-column align-items-center" action="/deleteSize" method="post">
                  <label for="">{{$size->name}}</label>
                  @csrf
                  <input type="hidden" name="sizeId" value="{{$size->id}}">
                  <button class="btn bg-dandelion" type="submit" name="" style="width: 110px;">Eliminar</button>
                </form>
              </div>
            <br>
        @endforeach
      </div>

      <div class="my-5">
        <label for="">Agregar talle de {{$category->name}}</label>
        <br>
        <a class="blueSlate hvr-shrink" id="addSize" uk-icon="icon: plus-circle; ratio: 4 ;"></a>
        <br>
      </div>

      <form class="" action="/addsize" method="post">
        @csrf
        {{-- En este div vacio se agrega una label y un input cada vez que se clickea el boton de agregar talle --}}
        <div class="container" id="divFormSize" class=""></div>
        @error ('sizes')
              <p style="color:red;" class="errorForm">{{ $message }}</p>
        @enderror
        <input type="hidden" name="categoryId" value="{{$category->id}}">
        <button class="btn bg-blueSlate" type="submit" name="">Agregar</button>
      </form>

    </div>

    <div class="mt-5">
      <a class="btn bg-dandelion" href="#confirm{{$category->id}}" uk-toggle>Eliminar Categoría</a>
      @include('partials.confirm',['url'=>"/deletecategory", 'message'=>"Seguro quiere eliminar la categoría {$category->name}?", 'name'=>'category_id', 'id'=>"{$category->id}"])
    </div>


<script src="/js/editcategory.js" charset="utf-8"></script>
@endsection
