@extends('layouts.plantilla')
@section('titulo')
Agregar Producto
@endsection
@section('main')

  <!-- Vista de agregar producto -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Agregar Producto</span></li>
  </ul>


  <div class="container text-center pb-4">

      <h2 class="regular text-center pb-3">Agregar <span class="bold blueSlate">Producto</span></h2>

      <div class="uk-card uk-card-default uk-card-body uk-margin-small">

        <form class="p-4" action="/addproduct" method="post" enctype="multipart/form-data">
          @csrf

          <div class="row">

            <div class="col-md-4 offset-md-2 mb-3">
              <input class="form-control-checkout" type="text" name="title" value="{{ old('title') }}" placeholder="Ingrese el nombre *" autofocus>
              @error('title')
                    <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <input class="form-control-checkout px-1" type="number" min="100" name="price" step="100" placeholder="Ingrese el precio *" @if (old('price') !== null) value="{{ old('price') }}" @else value="0" @endif>
              @error('price')
                <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="row">

            <div class="col-md-4 offset-md-2 mb-3">
              <input class="form-control-checkout" type="text" name="model"  placeholder="Ingrese el modelo *" @if (old('model') !== null) value="{{ old('model') }}" @else value="" @endif placeholder="Ingrese el modelo">
                @error('model')
                  <p class="errorForm">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
              <select id="category" class="form-control-checkout" name="category_id">
                <option value="">Seleccione una categoria *</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" {{($category->id == old('category_id'))?'selected': '' }}>{{$category->name}}</option>
                @endforeach
              </select>
              @error('category_id')
                    <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>


          </div>


          <div class="row">

            <div class="col-md-4 offset-md-2 mb-3">
              <select class="form-control-checkout" name="material_id" required>
                <option value="">Seleccione el material</option>
                @foreach ($materials as $material)
                  <option value="{{$material->id}}" {{($material->id == old('material_id'))?'selected': '' }}>{{$material->name}}</option>
                @endforeach
              </select>
              @error('material_id')
                    <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <select id="gender" class="form-control-checkout" name="gender_id">
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


          </div>



          <div class="row">


            <div class="col-md-4 offset-md-2 mb-3">
              <select class="form-control-checkout" name="age_id">
                <option value="">Seleccione una edad</option>
                @foreach ($ages as $age)
                  <option value="{{$age->id}}" {{($age->id == old('age_id'))?'selected': '' }}>{{$age->name}}</option>
                @endforeach
              </select>
              @error('age_id')
                    <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <select class="form-control-checkout" name="brand_id">
                <option value="">Seleccione una marca</option>
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
                <div class="col-md-4 offset-md-2 form-group-checkout mb-3">
                  <select id='onSale' class="form-control-checkout" name="onSale">
                    <option value =1 {{(1 == old('onSale'))?'selected': ''}}>Esta en oferta</option>
                    <option value =0 {{(0 == old('onSale'))?'selected': ''}}>No esta en oferta</option>
                  </select>
                </div>

                <div hidden id="discount" @if (old('onSale') == 1) class="col-md-4 form-group-checkout mb-3" @else class="col-md-4 form-group-checkout mb-3" @endif>
                  <input id="inputDiscount" class="form-control-checkout" type="number" name="discount" max="80" step="5"  placeholder="Descuento *"@if (old('discount') !== null) value="{{ old('discount') }}" @else value="" @endif >
                  @error('discount')
                    <p class="errorForm">{{ $message }}</p>
                  @enderror
                </div>
          </div>


          <div id="show_tags" hidden class="container">

            <label class="m-3">Lista de Tags:</label>

            <div id="tags" class="row justify-content-center">

              {{-- En este espacio se va a crear por JS los talles que correspondan a la categoria --}}

            </div>

          </div>

          {{-- ------------------------------------------------------------------------------------------- --}}

          <div id="show_stock" hidden class="container" style="max-width: 69%;">
            <br>

            <label  class="mt-3">Ingrese el stock por talle:</label>


            <div class="row justify-content-center" id="talles">
              <br>

              {{-- En este espacio se va a crear por JS los talles que correspondan a la categoria --}}

            </div>

          </div>


          <div class="m-4"></div> {{-- div separador --}}


          <div class="col-md-8 offset-md-2 form-group-checkout mb-3">
            <textarea class="p-3" name="description" rows="6" cols="80" placeholder="Escriba una descripción ..."></textarea>
          </div>

          <div class="m-4"></div> {{-- div separador --}}

          <div class="row">

            <div class="col-lg-4 offset-lg-4 form-group-checkout mb-3">
              <label for="">Agregue la/s imagenes del producto: *</label>
              <label for="file-upload" class="subir">
              <i class="fas fa-cloud-upload-alt"></i> Subir imágenes
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


          <div class="col-lg-4 offset-lg-4 form-group-checkout mb-3">
            <button class="btn bg-blueSlate" type="submit">Crear producto</button>
          </div>

        </form>

      </div>


  </div>


        @foreach ($categories as $category)

          {{-- Creamos los inputs hidden para los tags relacionados a cada categoria --}}
          @foreach ($category->tags as $tag)
            <input class="tag{{$category->id}}" type="text" hidden name="" value="{{$tag->name}}">
          @endforeach

          {{-- Creamos los inputs hidden para los talles relacionados a cada categoria --}}
          @foreach ($category->sizes as $size)
            <input class="categoria{{$category->id}}" type="text" hidden name="" value="{{$size->name}}">
          @endforeach

        @endforeach

    <script src="/js/addproduct.js" charset="utf-8"></script>
    {{-- <script src="/js/funciones.js" charset="utf-8"></script> --}}
@endsection
