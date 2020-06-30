@extends('layouts.plantilla')
@section('titulo')
Agregar Producto
@endsection
@section('main')
    <div class="container">
      <h2 class="col-md-4 offset-md-2 form-group">Agregar producto</h2>
      <form class="" action="/addproduct" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4 offset-md-2 form-group">
            <label>Nombre: *</label>
            <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Ingrese el nombre" autofocus>
            @error('title')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 form-group">
            <label>Precio: *</label>
            <input class="form-control" type="number" min="100" name="price" step="100" @if (old('price') !== null) value="{{ old('price') }}" @else value="0" @endif>
            @error('price')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 offset-md-2 form-group">
            <label>Modelo: *</label>
            <input class="form-control" type="text" name="model" @if (old('model') !== null) value="{{ old('model') }}" @else value="" @endif placeholder="Ingrese el modelo">
              @error('model')
                <p class="errorForm">{{ $message }}</p>
              @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 offset-md-2 form-group">
            <label for="category_id">Categoria: *</label>
            <select id="category" class="form-control" name="category_id">
              <option value="">Seleccione una categoria</option>
              @foreach ($categories as $category)
                <option value="{{$category->id}}" {{($category->id == old('category_id'))?'selected': '' }}>{{$category->name}}</option>
              @endforeach
            </select>
            @error('category_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 form-group">
            <label for="material_id">Material:*</label>
            <select class="form-control" name="material_id" required>
              <option value="">Seleccione una opcion</option>
              @foreach ($materials as $material)
                <option value="{{$material->id}}" {{($material->id == old('material_id'))?'selected': '' }}>{{$material->name}}</option>
              @endforeach
            </select>
            @error('material_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 offset-md-2 form-group">
            <label for="gender_id">Genero: *</label>
            <select id="gender" class="form-control" name="gender_id">
              <option value="3" {{(3 == old('gender_id'))?'selected': '' }}>Unisex</option>
              @foreach ($genders as $gender)
                @if ($gender->id==3)
                  {{-- que onda este else POR QUE FUNCIONA??????--}}
                @else
                  <option value="{{$gender->id}}" {{($gender->id == old('gender_id'))?'selected': '' }}>{{$gender->name}}</option>
                @endif
              @endforeach
            </select>
            @error('gender_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 form-group">
            <label for="age_id">Perfil:</label>
            <select class="form-control" name="age_id">
              <option value="">Seleccione una opcion</option>
              @foreach ($ages as $age)
                <option value="{{$age->id}}" {{($age->id == old('age_id'))?'selected': '' }}>{{$age->name}}</option>
              @endforeach
            </select>
            @error('age_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2 form-group">
            <label for="brand_id">Seleccione una marca:</label>
            <select class="form-control" name="brand_id">
              <option value="">Seleccione una opcion</option>
              @foreach ($brands as $brand)
                <option value="{{$brand->id}}" {{($brand->id == old('brand_id'))?'selected': '' }}>{{$brand->name}}</option>
              @endforeach
            </select>
            @error('brand_id')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
        </div>
          <div class="row">
                <div class="col-md-4 offset-md-2 form-group">
                  <label for="">En oferta?: </label>
                  <select id='onSale' class="form-control" name="onSale">
                    <option value =1 {{(1 == old('onSale'))?'selected': ''}}>Esta en oferta</option>
                    <option value =0 {{(0 == old('onSale'))?'selected': ''}}>No esta en oferta</option>
                  </select>
                </div>

                <div hidden id="discount" @if (old('onSale') == 1) class="col-md-4 form-group" @else class="col-md-4 form-group" @endif>
                  <label>Descuento</label>
                  <input id="inputDiscount" class="form-control" type="number" name="discount" max="80" step="5" @if (old('discount') !== null) value="{{ old('discount') }}" @else value="" @endif >
                  @error('discount')
                    <p class="errorForm">{{ $message }}</p>
                  @enderror
                </div>
          </div>
          <div id="tags" class="row"></div>
          <div class="row">
            <div class="col-md-4 offset-md-2 form-group">
              <label for="">Seleccione el stock por talle</label>
            </div>
          </div>
          {{-- Aca vamos a agregar los talles de la categoria seleccionada --}}
          <div class="row" id="talles"></div>
          <div class="col-md-4 offset-md-2 form-group">
            <div class="row">
              <h4>Descripcion del producto</h4>
            </div>
            <textarea name="description" rows="8" cols="80"></textarea>
          </div>

          <div class="row">
            <div class="col-lg-4 offset-lg-2 col-md-6  form-group">
              <label for="">Agregue la/s imagenes del producto: *</label>
              <label for="file-upload" class="subir">
              <i class="fas fa-cloud-upload-alt"></i> Subir imagen
              </label>
              <br>
              {{-- para poder agregar varios archivos hay que colocar los [] en el name del file y el atributo multiple --}}
              <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="images[]" value="" multiple >
              <div id="info"></div>
              @error('images')
                <p class="errorForm">{{ $message }}</p>
              @enderror
              <small id="emailHelp" class="form-text text-muted">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-2 col-md-6  form-group">
            <button class="btn" type="submit">Crear producto</button>
          </div>
        </form>
      </div>
      <div class="">
        {{-- Creamos los inputs hidden para los talles relacionados a cada categoria --}}
        @foreach ($categories as $category)
          @foreach ($category->sizes as $size)
            <input class="categoria{{$category->id}}" type="text" hidden name="" value="{{$size->name}}">
          @endforeach
        @endforeach
        {{-- Creamos los inputs hidden para los tags relacionados a cada categoria --}}
        @foreach ($categories as $category)
          @foreach ($category->tags as $tag)
            <input class="tag{{$category->name}}" type="text" hidden name="" value="{{$tag->name}}">
          @endforeach
        @endforeach
    </div>
<script type="text/javascript">
  window.addEventListener('load',function(){

    const category = document.getElementById('category');

    category.addEventListener('change',function(){
      // TALLES
      // Corresponde al div donde se agregaran los talles
      var divCentral = document.getElementById('talles')
      // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
      divCentral.innerHTML = ""

      // traemos los inputs de ese talle en particular
      var inputsTalles = document.querySelectorAll('.categoria' + category.value)

      for (var talle of inputsTalles) {

        var divTalle = document.createElement('div')

        var sizeLabel = document.createElement('label');

        sizeLabel.innerHTML = talle.value;

        var size = document.createElement('input');

        size.name = talle.value;
        size.setAttribute('type','number');
        size.value = 0

        divTalle.setAttribute('class','col-md-4 offset-md-2 form-group')

        divTalle.appendChild(sizeLabel)

        divTalle.appendChild(size)

        divCentral.appendChild(divTalle)

      }
      // En caso de que la categoria sea de talle unico agregamos igual mente el input de quantity
      if (inputsTalles.length===0) {
        var divTalle = document.createElement('div')
        divTalle.setAttribute('class','col-md-4 offset-md-2 form-group')
        var size = document.createElement('input');
        size.value = 0
        var sizeLabel = document.createElement('label');
        sizeLabel.innerHTML = "Talle Unico";
        size.setAttribute('type','number');
        divTalle.appendChild(sizeLabel)
        divTalle.appendChild(size)
        divCentral.appendChild(divTalle)
      }


    // TAGS
    // Corresponde al div donde se agregaran los tags
    var divCentral = document.getElementById('tags')
    // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
    divCentral.innerHTML = ""
    // Recopilamos los inputs de los tags correspondientes a esa categoria
    var inputTags = document.querySelectorAll('.tag' + category.value)
    // Recorremos cada uno y lo agregamos al div
    for (var tag of inputTags) {
      // Creamos el div individual que contendra un tag
      var divTag = document.createElement('div');
      // Le damos estetica
      divTag.setAttribute('class','col-md-4 offset-md-2 form-group')
      // Creamos un titulo h5 para cada tag
      var h5tag = document.createElement('h5');
      // Le damos al titulo el nombre del tag
      h5tag.innerHTML = tag.value;

      // Preparamos las opciones

      // Creamos el label y el input de la opcion Si
      var tagLabelSi = document.createElement('label');
      tagLabelSi.innerHTML = 'SI'

      var tagInputSi = document.createElement('input');
      tagInputSi.name = tag.value
      tagInputSi.value = 'true'
      tagInputSi.type = 'radio'

      // Creamos el label y el input de la opcion No
      var tagLabelNo = document.createElement('label');
      tagLabelNo.innerHTML = 'NO'

      var tagInputNo = document.createElement('input');
      tagInputNo.name = tag.value
      tagInputNo.value = 'false'
      tagInputNo.type = 'radio'

      // Armamos el div del tag individual
      divTag.appendChild(h5tag)
      divTag.appendChild(tagLabelSi)
      divTag.appendChild(tagInputSi)
      divTag.appendChild(tagLabelNo)
      divTag.appendChild(tagInputNo)

      // Lo agregamos al div central de tags
      divCentral.appendChild(divTag)
    }
    })
  })
</script>
<script type="text/javascript">
window.addEventListener('load',function(){

// Creacion de input descuento en vista add product
function onSale(){
  // Selecciono el select con id onSale y el div de discount que tiene la clase hidden
  var onSale = document.getElementById('onSale');
  var discount = document.getElementById('discount');
  var inputDiscount = document.getElementById('inputDiscount');

      // Creo un evento que actue cuando cambia el value del input onSale
      onSale.addEventListener('change',function(){
        if (onSale.value==1) {
          discount.removeAttribute("hidden",'false');
        } else {
          discount.setAttribute("hidden",'true');
          inputDiscount.value=null;
        }
  }) // cierre del evento change de onSale
}// cierre de la funcion onSale
onSale();

})
</script>
@endsection
