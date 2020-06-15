@extends('layouts.plantilla')
@section('titulo')
asd test
@endsection
@section('main')

  <style media="screen">

    .ar-image {
      position: relative;
    }

    /* Div que contiene la background image, se le da una altura y filtros para que haya transition */
    .article-image{
    transition: .4s ease-in-out;
    -webkit-filter: brightness(100%);
    filter: brightness(100%);
}

.ar-image:hover .article-image{
    transition: .4s ease-in-out;
    -webkit-filter: brightness(50%);
    filter: brightness(50%);
    transform: none;
}

    p {
      color: white;
      position: absolute;
      top: 50%;
      left: 55%;
      transform: translate(-50%, -50%);
      width: max-content;
      max-width: 100%;
      box-sizing: border-box;
    }



    .img-hover-zoom {
      height: 100%; /* Modify this according to your need */
      overflow: hidden; /* Removing this will break the effects */
    }


    /* Quick-zoom Container */
.img-hover-zoom--basic img {
  transform-origin: 0 0;
  transition: transform .25s, visibility .25s ease-in;
}

/* The Transformation */
.img-hover-zoom--basic:hover img {
  transform: scale(1.1, 1.1);
}

  </style>

  <div class="uk-child-width-1-2 uk-child-width-1-3@m" uk-grid>

    <div class="ar-image">
      <div class="uk-inline-clip uk-transition-toggle article-image" tabindex="0">
        <img class="uk-transition-scale-up uk-transition-opaque" src="img/aros.jpg" alt="">
        {{-- <div class="uk-position-center">
            <div class="uk-light"><h3 class="medium uk-margin-remove">Aros</h3></div>
        </div> --}}
      </div>
      <p>Aros</p>
    </div>

    <div>
      <div class="img-hover-zoom img-hover-zoom--basic" tabindex="0">
        <img class="" src="img/pulseras.jpg" alt="">
        {{-- <div class="uk-position-center">
            <div class="uk-light"><h3 class="uk-margin-remove">Pulseras</h3></div>
        </div> --}}
      </div>
      <p>basic</p>
    </div>

    <div>
      <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
        <img class="brightness uk-transition-scale-up uk-transition-opaque" src="img/collares.jpg" alt="">
        {{-- <div class="uk-position-center">
            <div class="uk-light"><h3 class="uk-margin-remove">Collares</h3></div>
        </div> --}}
      </div>
    </div>




@endsection
