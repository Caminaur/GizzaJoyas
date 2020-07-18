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
    <script src="/js/addproduct.js" charset="utf-8"></script>
@endsection
