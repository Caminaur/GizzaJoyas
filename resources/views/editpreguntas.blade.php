@extends('layouts.plantilla')
@section('titulo')
Editar Preguntas Frecuentes
@endsection
@section('main')

  <!-- Vista de editar preguntas frecuentes -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/adminpanel">Volver</a></li>
    <li><span class="dandelion">Editar Preguntas</span></li>
  </ul>

  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Agregar una <span class="bold blueSlate">Pregunta</span></h2>

      <form action='/createfaq' method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
          {{-- Titulo--}}
          <label for="">Titulo: </label>
          <input type="text" hidden name="id" value="">
          <input type="text" class="form-control-checkout" name="title" value="">
          @error('title')
            <p class="errorForm">{{ $message }}</p>
          @enderror

          <br>

          {{-- Texto --}}
          <label for="">Descripción: </label>
          <br>
          <textarea name="description" rows="8" cols="80" value=""></textarea>
          @error('description')
            <p class="errorForm">{{ $message }}</p>
          @enderror

          <div class="my-3 row justify-content-center">
            <div class="form-group-checkout">
              <label for="">Agregar imagen:</label><br>
              <label for="file-upload" class="subir"><i class="fas fa-cloud-upload-alt"></i> Subir imagen</label>
              <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="image" value="">
              <div id="info"></div>
              @error('image')
                <p class="errorForm">{{ $message }}</p>
              @enderror
              <small id="emailHelp" class="form-text ">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small>
              <input type="hidden" name="faqid" value="">
            </div>
          </div>


          <button type="submit" class="btn bg-blueSlate">Agregar</button>
        </div>
      </form>

    <h2 class="regular text-center pb-3">Editar una <span class="bold blueSlate">Pregunta</span></h2>


      @foreach ($faqs as $faq)


      <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>

        <form class="form-signup" action='/editfaq' method="post" enctype="multipart/form-data">

          {{csrf_field()}}
          @method('put')

          {{-- Titulo --}}
          <label for="">Titulo: </label>
          <input type="text" hidden name="id" value="{{$faq->id}}">
          <input type="text" class="form-control-checkout" name="title" value="{{$faq->title}}">
          @error('title')
            <p class="errorForm">{{ $message }}</p>
          @enderror

          <br>

          {{-- Texto --}}
          <label for="">Descripción: </label>
          <br>
          <textarea name="description" rows="8" cols="80" value="{{$faq->description}}">{{$faq->description}}</textarea>
          @error('description')
            <p class="errorForm">{{ $message }}</p>
          @enderror

          {{-- Imagen --}}
          <div class="my-3 row justify-content-center">
            <div class="form-group-checkout">
              <label for="">Agregar imagen:</label><br>
              <label for="file-upload{{$faq->id}}" class="subir"><i class="fas fa-cloud-upload-alt"></i> Subir imagen</label>
              <input type="file" id="file-upload{{$faq->id}}" onchange='change()' style='display: none;' class="sin-archivo"  name="image" value="">
              <div id="info"></div>
              @error('image')
                <p class="errorForm">{{ $message }}</p>
              @enderror
              <small id="emailHelp" class="form-text ">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small>
            </div>
          </div>

          <button hidden id="botoneditar{{$faq->id}}" type="submit" class="btn bg-ashBlue">Editar</button>

        </form>

        {{-- Si ya tiene una imagen relacionada la traigo--}}
        @if ($faq->image_path)
          <div class="flex position-relative">
            <img style="width:300px;" src="/storage/{{$faq->image_path}}" alt=""><br>
            <a class="hvr-shrink rounded-icon ico" style="background-color: black; border: 1px solid white; border-radius: 30px; position: absolute;  z-index: 1;  color: white;  top: 2%;  right: 20%;" href="#confirmimage{{$faq->id}}" uk-icon="icon: trash;" uk-toggle></a>
          </div>
          <!-- This is the modal -->
          @include('partials.confirmimage',['url'=>"/faq/deleteimage", 'message'=>'Seguro quiere eliminar la Imagen seleccionada?', 'name'=>'faqid', 'id'=>"{$faq->id}"])
        @endif



        <label for="botoneditar{{$faq->id}}" class="btn bg-ashBlue my-5" type="submit">Editar</label>

        <br>

        {{-- Eliminar pregunta --}}
        <a class="btn bg-dandelion" href="#confirm{{$faq->id}}" uk-toggle>Eliminar</a>
        <!-- This is the modal -->
        @include('partials.confirm',['url'=>"/deletefaq", 'message'=>'Seguro quiere eliminar la pregunta seleccionada?', 'name'=>'faqid', 'id'=>"{$faq->id}"])




      </div>
    @endforeach

  </div>

@endsection
