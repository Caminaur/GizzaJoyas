@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('css')
editcategory
@endsection('css')
@section('main')
  <div class="container">
    <h2>Editar categoría {{$category->name}}</h2>
    <form class="" action="/changeName" method="post" enctype="multipart/form-data">
      @csrf
      <div class="col-md-4 form-group">
        <label for="category_id">categoría: *</label>
        <input type="text" name="category_name" value="{{$category->name}}">
        <input type="hidden" name="category_id" value="{{$category->id}}">
      </div>
      <button class="col-md-2 offset-md-1" type="submit" name="button">Cambiar nombre</button>
    </form>
      <div class="col-md-4 mt-2 form-group">
        <h2>Imagen de la categoría</h2>
      </div>
      <div class="col-md-4 mt-2 form-group">
        <img src="/storage/{{$category->image}}" alt="">
      </div>
      <div class="col-md-6 form-group">
        <form class="" action="/changeCategoryImage" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <label for="">Cambiar imagen de la categoría: *</label>
          <div class="col-lg-8 form-group">
            <label for="file-upload" class="subir">
              <i class="fas fa-cloud-upload-alt"></i> Subir imagen
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
          <button type="submit" name="button">Cambiar la imagen</button>
        </form>
      </div>
      <h2>Tags relacionados a esta categoría</h2>
      <div class="row">
        @foreach ($category->tags as $tag)
          <div class="col-4 col-lg-4 mx-3 list-group-item form-group">
            <form class="" action="/deleteCategoryTag" method="post">
              <h2 for="">{{$tag->name}}</h2>
              @csrf
              <input type="hidden" name="tagId" value="{{$tag->id}}">
              <input type="hidden" name="categoryId" value="{{$category->id}}">
              <button class="btn-secondary" type="submit" name="">Eliminar Relacion</button>
            </form>
          </div>
          <br>
        @endforeach
      </div>
      <div class="col-4 col-lg-2 form-group" hidden id="addTagId" class="">
        <form class=""  action="/selecttag" method="post">
          @csrf
          <label for="">Tags </label>
          <select class="" name="tagId">
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
          <button class="btn-secondary" type="submit" name="">Agregar tag a {{$category->name}}</button>
          <button type="button" id="btnHide" name="button">Ocultar</button>
        </form>
      </div>
      <div id="createTagDiv" hidden class="col-4 form-group">
        <form class="" action="/createtag" method="post">
          @csrf
          <label for="">Nombre</label>
          <input type="text" name="name" value="">
          <input type="hidden" name="category_id" value="{{$category->id}}">
          <button class="btn-secondary" type="submit" name="">Crear Tag</button>
          <button type="button" id="hideCreateTag" name="">Ocultar</button>
        </form>
      </div>
      <button class="btn-primary" id="addTag" type="button" name="button">Agregar Tag existente</button>
      <button class="btn-primary" id="createTag" type="button" name="button">Crear Tag y asignarlo a esta categoría</button>
      <div class="row">
        @foreach ($sizes as $size)
            <div class="col-4 col-lg-4 mt-2 list-group-item form-group">
                <form class="" action="/deleteSize" method="post">
                  <h2 for="">{{$size->name}}</h2>
                  @csrf
                  <input type="hidden" name="sizeId" value="{{$size->id}}">
                  <button class="btn" type="submit" name="">Eliminar Talle</button>
                </form>
              </div>
            <br>
        @endforeach
      </div>
      <h3>Agregar talle de {{$category->name}}</h3>
      <form class="" action="/addsize" method="post">
        @csrf
        {{-- En este div vacio se agrega una label y un input cada vez que se clickea el boton de agregar talle --}}
        <div class="container" id="divFormSize" class=""></div>
        @error ('sizes')
              <p style="color:red;" class="errorForm">{{ $message }}</p>
        @enderror
        <input type="hidden" name="categoryId" value="{{$category->id}}">
        <button id="addSize" class="offset-md-2 form-group" type="button" name="">Agregar talle</button>
        <button type="submit" name="">Actualizar talles</button>
      </form>
      <div class="">
          <button uk-toggle='target: #confirm' class="btn btn-danger" type="button" >Eliminar categoría y relaciones de esta</button>
          @include('partials.confirm',['url'=>'/deletecategory','message'=>'Borrar una categoría borrará todos los productos relacionados a esta! esta seguro?','name'=>'catergory_id','id'=>'{{$category->id}}'])
      </div>
  </div>
<script src="/js/editcategory.js" charset="utf-8"></script>
@endsection
