@extends('layouts.plantilla')
@section('titulo')
Edit product
@endsection
@section('main')

  <!-- Vista de agregar producto -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Editar Producto</span></li>
  </ul>


  <div class="container text-center pb-4">

      <h2 class="regular text-center pb-3">Editar <span class="bold blueSlate">Producto</span></h2>

      <div class="uk-card uk-card-default uk-card-body uk-margin-small">

      <form class="p-4" action='/editproduct/{{$product['id']}}' method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">

          <div class="col-md-4 offset-md-2 mb-3">
            <input class="form-control-checkout" type="text" name="title" value="{{$product->name}}" placeholder="Ingrese el nombre" autofocus>
            @error('title')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <input class="form-control-checkout px-1" type="number" min="100" name="price" step="100" value={{$product->price}}>
            @error('price')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

        </div>

        <div class="row">

          <div class="col-md-4 offset-md-2 mb-3">
            <input class="form-control-checkout" type="text" class="form-control-checkout" name="model" value="{{ old('model',$product->model)}}">
            @error('model')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <select id="category" class="form-control-checkout" name="category_id">
              <option value="{{$product->category->name}}">{{$product->category->name}}</option>
            </select>
            <small>La categoria no puede ser modificada</small>
            @error('category_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

        </div>

        <div class="row">

          <div class="col-md-4 offset-md-2 mb-3">
            <select class="form-control-checkout" name="material_id">
              <option value="">Seleccione un Material</option>
              @foreach ($materials as $material)
                <option value="{{$material->id}}" {{($material->id == $product->material_id)?'selected': '' }}>{{$material->name}}</option>
              @endforeach
            </select>
            @error('material_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <select id="gender" class="form-control-checkout" name="gender_id">
              <option value="">Seleccione un Género</option>
              @foreach ($genders as $gender)
                <option value="{{$gender->id}}" {{($gender->id == $product->gender_id)?'selected': '' }}>{{$gender->name}}</option>
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
              <option value="">Seleccione un Público</option>
              @foreach ($ages as $age)
                <option value="{{$age->id}}" {{($age->id == $product->age_id)?'selected': '' }}>{{$age->name}}</option>
              @endforeach
            </select>
            @error('age_id')
                  <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <select class="form-control-checkout" name="brand_id">
              <option value="">Seleccione una Marca</option>
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

          <div class="col-md-4 offset-md-2 form-group-checkout mb-3">
            <select id='onSale' class="form-control-checkout" name="onSale">
              <option value =1 {{(1 == $product->onSale)?'selected': ''}}>Está en oferta</option>
              <option value =0 {{(0 == $product->onSale)?'selected': ''}}>No está en oferta</option>
            </select>
          </div>

          @if ($product->onSale==0)
            <div hidden id="discount" class="col-md-4 form-group-checkout mb-3">
              <input id="inputDiscount" class="form-control-checkout px-1" type="number" name="discount" max="80" step="5" @if (old('discount') !== null) value="{{ $product->discount }}" @else value="" @endif >
                @error('discount')
                  <p class="errorForm">{{ $message }}</p>
                @enderror
            </div>
          @else
            <div id="discount" class="col-md-4 form-group-checkout mb-3">
              <input id="inputDiscount" class="form-control-checkout px-1" type="number" name="discount" max="80" step="5" @if ($product->discount !== null) value="{{ $product->discount }}" @else value="" @endif >
              @error('discount')
                <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>
          @endif

        </div>

        <label class="m-3">Lista de Tags:</label>

        <div id="tags" class="row justify-content-center">

          @php
            $i=0;
          @endphp

          @foreach ($product->tags as $tag)

            <div class='col-md-3 centrado'>
              <label for="">{{$tag->name}}</label>
              <input type="checkbox" name="{{$tag->name}}" value="true" @if ($product_tags[$i]->hasTag==true) {{'checked '}}@endif>
            </div>

            @php
            $i++;
            @endphp

          @endforeach

        </div>

        {{-- ------------------------------------------------------------------------------------------- --}}


        <div id="show_stock" class="container" style="max-width: 69%;">
          <label  class="mt-3">Ingrese el stock por talle:</label>



          {{-- Aca vamos a agregar los talles de la categoria seleccionada --}}
          <div class="row justify-content-center" id="talles">

            @if ($product->category)
              @foreach ($product->stocks as $stock)
                <div class="centrado col-6 col-lg-2 form-group">
                  <label for="">{{$stock->size->name}}</label>
                  <input type="number" class="form-control-checkout px-1" name="{{$stock->size->name}}" value="{{$stock->quantity}}">
                </div>
              @endforeach
            @endif
          </div>

        </div>

        <div class="m-4"></div> {{-- div separador --}}

        <div class="col-md-8 offset-md-2 form-group-checkout mb-3">
          <textarea class="p-3" name="description" rows="6" cols="80" placeholder="Escriba una descripción ...">{{$product->description}}</textarea>
        </div>

        <div class="m-5"></div> {{-- div separador --}}

          <div class="row justify-content-center">

            {{-- @foreach ($product->images as $image)
              <div class="col-12 col-md-3 form-group ">
                <img class="edit-img" src="{{$image->path}}" alt="Imagen del Producto">
                <!-- This is the modal -->
                @include('partials.confirm',['url'=>"/deleteimage/$image->id", 'message'=>'Seguro quiere eliminar la Imagen seleccionada?', 'id'=>"{$image->id}"])
                <a class="hvr-shrink rounded-icon ico" style="background-color:black ; border: 1px solid white; border-radius: 30px; position: absolute;  z-index: 1;  color: white;  bottom: 6%;  left: 46%;" href="#confirm{{$image->id}}" uk-icon="icon: trash;" uk-toggle></a>
              </div>
            @endforeach --}}

          </div>

            <div class="row justify-content-center">

            <div class="col-lg-4 form-group-checkout mb-3">
              <label for="">Agregar imagenes al producto: *</label>
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

            {{-- Este boton esta oculto y se activa con un label que esta fuera del formulario --}}
            <button hidden class="btn border-ashBlue" type="submit">Editar producto</button>

      </form>


      <div class="row justify-content-center">

        {{-- Colocamos el form de borrar imagen fuera del form de editar producto ya que no pueden anidarse los forms --}}
        @foreach ($product->images as $image)
          <div class="col-12 col-md-3 form-group">
            <img class="edit-img" src="{{$image->path}}" alt="Imagen del Producto">
            <!-- This is the modal -->
            @include('partials.confirm',['url'=>"/deleteimage/$image->id", 'message'=>'Seguro quiere eliminar la Imagen seleccionada?', 'id'=>"{$image->id}"])
            <a class="hvr-shrink rounded-icon ico" style="background-color:black ; border: 1px solid white; border-radius: 30px; position: absolute;  z-index: 1;  color: white;  bottom: 6%;  left: 46%;" href="#confirm{{$image->id}}" uk-icon="icon: trash;" uk-toggle></a>
          </div>
        @endforeach

      </div>

        <label class="btn bg-blueSlate my-5" type="submit">Editar producto</label>
      </div>


      <div>
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

    </div>
  </div>
@endsection
<script src="/js/editproduct.js" charset="utf-8"></script>
