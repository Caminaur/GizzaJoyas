@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('main')
      <div class="container">
        <h2 class="col-md-4 offset-md-2 form-group">Editar producto</h2>
        <form class="" action='/editproduct/{{$product['id']}}' method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="productId" value="{{$product->id}}">
          <div class="row">
          <div class="col-md-4 offset-md-2 form-group">
            <label>Nombre: *</label>
            <input class="form-control" type="text" name="title" value="{{$product->name}}" placeholder="Ingrese el nombre" autofocus>
            @error('title')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 form-group">
            <label>Precio: *</label>
            <input class="form-control" type="number" min="100" name="price" step="100" value={{$product->price}}>
            @error('price')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 offset-md-2 form-group">
            <label for="">Modelo: *</label>
            <input class="form-control type="text" class="form-control" name="model" value="{{ old('model',$product->model)}}">
            @error('model')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

        </div>

        <div class="row">
          <div class="col-md-4 offset-md-2 form-group">
            <label for="category_id">Categoria: *</label>
            <select id="category" class="form-control" name="category_id">
              <option value="{{$product->category->name}}">{{$product->category->name}}</option>
            </select>
            <small>La categoria no puede ser modificada</small>
            @error('category_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 form-group">
            <label for="material_id">Material:</label>
            <select class="form-control" name="material_id">
              <option value="">Seleccione una opcion</option>
              @foreach ($materials as $material)
                <option value="{{$material->id}}" {{($material->id == $product->material_id)?'selected': '' }}>{{$material->name}}</option>
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
              <option value="">Seleccione un genero</option>
              @foreach ($genders as $gender)
                <option value="{{$gender->id}}" {{($gender->id == $product->gender_id)?'selected': '' }}>{{$gender->name}}</option>
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
                <option value="{{$age->id}}" {{($age->id == $product->age_id)?'selected': '' }}>{{$age->name}}</option>
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
                <option value="{{$brand->id}}" {{($brand->id == $product->brand_id)?'selected': '' }}>{{$brand->name}}</option>
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
                    <option value =1 {{(1 == $product->onSale)?'selected': ''}}>Esta en oferta</option>
                    <option value =0 {{(0 == $product->onSale)?'selected': ''}}>No esta en oferta</option>
                  </select>
                </div>
                @if ($product->onSale==0)
                  <div hidden id="discount" @if (old('onSale') == 1) class="col-md-4 form-group" @else class="col-md-4 form-group" @endif>
                    <label>Descuento</label>
                    <input id="inputDiscount" class="form-control" type="number" name="discount" max="80" step="5" @if (old('discount') !== null) value="{{ $product->discount }}" @else value="" @endif >
                      @error('discount')
                        <p class="errorForm">{{ $message }}</p>
                      @enderror
                @else
                  <div id="discount" class="col-md-4 form-group">
                    <label>Descuento</label>
                    <input id="inputDiscount" class="form-control" type="number" name="discount" max="80" step="5" @if ($product->discount !== null) value="{{ $product->discount }}" @else value="" @endif >
                    @error('discount')
                      <p class="errorForm">{{ $message }}</p>
                    @enderror
                @endif
                </div>
          </div>
          <div id="tags" class="row">
            @php
              $i=0;
            @endphp
            @foreach ($product->tags as $tag)
              <div class='col-md-4 offset-md-2 form-group'>
                <h5>{{$tag->name}}</h5>
                <label for="">Si</label>
                <input type="radio" name="{{$tag->name}}" value="true" @if ($product_tags[$i]->hasTag==true) {{'checked '}}@endif>
                <label for="">No</label>
                <input type="radio" name="{{$tag->name}}" value="false" @if ($product_tags[$i]->hasTag==false) {{'checked '}}@endif >
              </div>
              @php
              $i++;
              @endphp
            @endforeach
          </div>
          <div class="row">
            <div class="col-md-4 offset-md-2 form-group">
              <label for="">Seleccione el stock por talle</label>
            </div>
          </div>
          {{-- Aca vamos a agregar los talles de la categoria seleccionada --}}
          <div class="row" id="talles">
            @if ($product->category)
              @foreach ($product->stocks as $stock)
                <div class="col-md-4 offset-md-2 form-group">
                  <label for="">{{$stock->size->name}}</label>
                  <input type="number" name="{{$stock->size->name}}" value="{{$stock->quantity}}">
                </div>
              @endforeach
            @endif
          </div>
          <div class="col-md-4 offset-md-2 form-group">
            <div class="row">
              <h4>Descripcion del producto</h4>
            </div>
            <textarea name="description" rows="8" cols="80">{{$product->description}}</textarea>
          </div>

          <div class="row">
            @foreach ($product->images as $image)
              <div class="col-lg-4 offset-lg-2 col-md-6  form-group">
                <img src="/storage/{{$image->path}}" alt="">
                  <a href="/deleteimage/{{$image->id}}" type="submit" name="button">Borrar imagen</a>
              </div>
            @endforeach
            <div class="col-lg-4 offset-lg-2 col-md-6  form-group">
              <label for="">Agregar imagenes al producto: *</label>
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
            <button class="btn" type="submit">Editar producto</button>
          </div>
        </div>
        </form>
      <div class="">
        {{-- Creamos los inputs hidden para los talles relacionados a cada categoria --}}
        @foreach ($categories as $category)
          @foreach ($category->sizes as $size)
            <input class="{{$category->name}}" type="text" hidden name="" value="{{$size->name}}">
          @endforeach
        @endforeach
        {{-- Creamos los inputs hidden para los tags relacionados a cada categoria --}}
        @foreach ($categories as $category)
          @foreach ($category->tags as $tag)
            <input class="tag{{$category->name}}" type="text" hidden name="" value="{{$tag->name}}">
          @endforeach
        @endforeach
      </div>


@endsection
<script src="/js/editproduct.js" charset="utf-8"></script>
