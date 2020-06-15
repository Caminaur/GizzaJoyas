@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('css')
editcategory
@endsection('css')
@section('main')
  <div class="container">
    <h2>Editar categoria {{$category->name}}</h2>
    <form class="" action="index.html" method="post" enctype="multipart/form-data">
      <div class="col-md-4 offset-md-2 form-group">
        <label for="category_id">Categoria: *</label>
        <input type="text" name="category_name" value="{{$category->name}}">
      </div>
      <button class="col-md-2 offset-md-3" type="submit" name="button">Cambiar nombre</button>
    </form>
      <div class="col-md-4 offset-md-2 form-group">
        <h2>Imagen de la categoria</h2>
        <img src="/storage/{{$category->image}}" alt="">
      </div>
      <div class="col-md-4 offset-md-2 form-group">
        <form class="" action="/changeCategoryImage" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <div class="col-lg-4 offset-lg-2 col-md-6  form-group">
            <label for="">Cambiar imagen de la categoria: *</label>
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
            <small id="emailHelp" class="form-text text-muted">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
          </div>
          <button type="submit" name="button">Cambiar la imagen</button>
        </form>
      </div>
      @foreach ($sizes as $size)
          <div class="col-4 col-lg-2 form-group">
            {{-- Editar el nombre de un talle no tiene sentido y puede perjudicar la DB
            digamos que editan el talle 13 para que sea 12, todos los stocks relacionados se verian alterados --}}
            {{-- <form class="row" action="/delteSize" method="post">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="sizeId" value="{{$size->id}}">
              <input class="col-md-3 offset-md-1" type="text" name="{{$size->name}}" value="{{$size->name}}">
              <button class="col-md-4 offset-md-1 btn" type="submit" name="">Editar</button>
            </form> --}}
            <form class="" action="/deleteSize" method="post">
              <h2 for="">{{$size->name}}</h2>
              @csrf
              <input type="hidden" name="sizeId" value="{{$size->id}}">
              <button class="btn" type="submit" name="">Eliminar Talle</button>
            </form>
          </div>
          <br>
      @endforeach
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
  </div>
<script type="text/javascript">
  window.addEventListener('load',function(){
    const divFormSize = document.getElementById('divFormSize');
    const AddSizeButton = document.getElementById('addSize');
    AddSizeButton.addEventListener('click',function(){
      // creamos la label
      var label = document.createElement('label');
      label.innerHTML = "Ingrese el talle";
      // creamos el input
      var input = document.createElement('input');
      input.name = 'sizes[]';
      input.setAttribute('required','true');
      input.setAttribute('class','ml-3');
      // creamos un div para organizarlos
      var div = document.createElement('div');
      // <button type="button" class="close" aria-label="Close">
      //   <span aria-hidden="true">&times;</span>
      // </button>
      // boton de borrado
      var button = document.createElement('button');
      button.setAttribute('type','button');
      button.setAttribute('class','close');
      button.setAttribute('aria-label','Close');
      // span
      var span = document.createElement('span');
      span.setAttribute('aria-hidden','true');
      span.setAttribute('class','botonEliminar');
      span.innerHTML = '&times;';

      button.appendChild(span);

      div.setAttribute('class','row m-2 p-2');
      div.appendChild(label);
      div.appendChild(input);
      div.appendChild(button);
      divFormSize.appendChild(div);
      // Agregar boton para eliminar el input de forma individual
      button.addEventListener('click',function(){
        this.parentNode.parentNode.removeChild(this.parentNode);
      })
    });
  });
</script>
@endsection
