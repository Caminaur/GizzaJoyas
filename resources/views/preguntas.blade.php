@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li><a href="">Inicio</a></li>
    <li><span class="dandelion">Preguntas Frecuentes</span></li>
  </ul>

  <div class="uk-background-muted p-4">


    <section>

      @foreach ($faqs as $faq)
        <a class="w-100 text-left hvr-icon-down uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple{{$faq->id}}; animation:  uk-animation-slide-left, uk-animation-slide-bottom">{{$faq->title}} <i class="hvr-icon fas fa-chevron-down"></i></a>
        <div id="toggle-animation-multiple{{$faq->id}}" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>{{$faq->description}}</div>
        <br>

        {{-- Si hay una imagen --}}
        {{-- @if ($faq->image_path)
        podria hacer un modal
        @endif --}}
      @endforeach

    </section>

  </div>

@endsection
