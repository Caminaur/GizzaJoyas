@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')
  <div class="container">
    <h2 class="">Editar Preguntas Frecuentes</h2>
  <div style="background:#6B799E;" class="uk-background-muted p-4">

    <section>
      @foreach ($faqs as $faq)
        <div class="m-2">
        {{-- Titulo --}}
        <form class="form-signup" action='/editfaq' method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')

          <div class="">
            <label for="">Titulo: </label>
            <input type="text" hidden name="id" value="{{$faq->id}}">
            <input type="text" class="form-control" name="title" value="{{$faq->title}}">
            @error('title')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <div class="">
            {{-- Texto --}}
            <label for="">Descripción: </label>
            <br>
            <textarea class="form-control" name="description" rows="8" cols="80" value="{{$faq->description}}">{{$faq->description}}</textarea>
            @error('description')
              <p class="errorForm">{{ $message }}</p>
            @enderror

            <button type="submit" hidden id="botoneditar{{$faq->id}}" class="btn enviar">Editar pregunta</button>
          </div>
        </form>


        {{-- Imagen --}}
        <form class="" action="/faq/addimage" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="offset-lg-2 col-md-6  form-group">
              <label for="">Agregar imagen</label><br>
              <input type="file" name="image" value="">

              @error('image')
                <p class="errorForm">{{ $message }}</p>
              @enderror

              <small id="emailHelp" class="form-text ">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
              <input type="hidden" name="faqid" value="{{$faq->id}}"><br>
              <button type="submit" class="btn enviar">Agregar imagen</button>
            </div>
          </div>
        </form>
          {{-- Si ya tiene una imagen relacionada --}}
          @if ($faq->image_path)
            <div class="flex">
              <form class="" action="/faq/deleteimage" method="post">
                @csrf
                <img class="product-img" style="margin-bottom:10px;margin-top:10px;" src="/storage/{{$faq->image_path}}" alt=""><br>
                <input type="hidden" name="faqid" value="{{$faq->id}}">
                <button type="submit" class="eliminar-imagen" name="">X</button>
                <div hidden class="divErrorImagen">
                  <p class="mensajeErrorImagen"></p>
                </div>
              </form>
            </div>
          @endif
          <br>
          <div class="flex">
            <label class="btn enviar" for="botoneditar{{$faq->id}}">Editar Pregunta</label>

            {{-- Eliminar pregunta --}}
            <form class="" action="/deletefaq" method="post">
              {{csrf_field()}}
              <input type="text" hidden name="id" value="{{$faq->id}}">
              <button class="btn btn-danger" type="submit" name="button">Eliminar Pregunta</button>
            </form>
          </div>
        </div>
      @endforeach

      </div>
      <div class="m-2">
        <h2>Agregar nueva pregunta</h2>
        {{-- Titulo --}}
        <form class="form-signup" action='/createfaq' method="post" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="">
            <label for="">Titulo: </label>
            <input type="text" hidden name="id" value="">
            <input type="text" class="form-control" name="title" value="">
            @error('title')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <div class="">
            {{-- Texto --}}
            <label for="">Descripción: </label>
            <br>
            <textarea class="form-control" name="description" rows="8" cols="80" value=""></textarea>
            @error('description')
              <p class="errorForm">{{ $message }}</p>
            @enderror
            <div class="offset-lg-2 col-md-6  form-group">
              <label for="">Agregar imagen</label><br>
              <input type="file" name="image" value="">

              @error('image')
                <p class="errorForm">{{ $message }}</p>
              @enderror

              <small id="emailHelp" class="form-text ">Extensiones: jpg, jpeg, png. Peso maximo 2MB</small><br>
            </div>
            <button type="submit" class="btn enviar">Agregar pregunta</button>
          </div>
        </form>
      </div>
    </section>
  </div>

@endsection
