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
  <script type="text/javascript">
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
  </script>
@endsection
