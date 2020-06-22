@extends('layouts.plantilla')
@section('titulo')
Productos
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li><a href="">Categorias</a></li>
    <li><span class="dandelion">Anillos</span></li>
  </ul>

  <h1 class="medium text-center p-4">Anillos</h1>

  <section id="productos" class="container mb-5">

    <div class="uk-child-width-1-2 uk-child-width-1-3@m" uk-grid uk-height-match="target: > div > .product"> {{-- para igualar la altura use este atributo match--}}

      <div>

        <div class="product uk-text-center pb-4">

          <div class="uk-inline-clip uk-transition-toggle inside" tabindex="0">
            <a href="/producto">
            <img src="img/anillos.jpg" alt="">
            <img class="uk-transition-scale-up uk-position-cover" src="img/aros.jpg" alt="">
            {{-- <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
              <p class="uk-h4 uk-margin-remove" style="color:white;">Ver más</p>
            </div> --}}

            <div class="onSale-label">
              <ul class="">
                <li class="sale"><h4>25% off</h4></li>
              </ul>
            </div>

            {{-- Si sos admin ves iconos de edicion --}}
            <div class="uk-visible-toggle icons-product" tabindex="-1">
              <div class="uk-flex-center pt-3" uk-grid>
                <div class="uk-width-auto">
                    <ul class="uk-iconnav">
                      <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/favoritos"><i class="hvr-icon far fa-heart"></i></a></li>
                      <li><a class="rounded-icon ico hvr-icon-rotate" href="/cart"><span class="hvr-icon" uk-icon="icon: cart"></span></a></li>
                      @if (Auth::user())
                        @if (Auth::user()->isAdmin == true)
                      <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/edit"><span class="hvr-icon" uk-icon="icon: pencil"></span></a></li>
                      <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/copy"><span class="hvr-icon" uk-icon="icon: copy"></span></a></li>
                      <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/delete"><span class="hvr-icon" uk-icon="icon: trash"></span></a></li>
                        @endif
                      @endif
                    </ul>
                </div>
              </div>
            </div>

            </a>
          </div>

          <h3 class="product-desc uk-margin-small-top mb-3">Collar Primavera</h3>
          <div class="uk-flex uk-flex-center mb-3">
            <h3 class="dandelion mx-1 sinOferta">$500</h3><h3 class="doveGrey mx-1">$250</h3>
          </div>

          <a class="btn border-ashBlue" href="#">Solicitar stock</a>

        </div>
      </div>

      <div class="uk-text-center">
        <div class="product">

          <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
              <img src="img/anillos.jpg" alt="">
              <img class="uk-transition-scale-up uk-position-cover" src="img/aros.jpg" alt="">
              <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                  <p class="uk-h4 uk-margin-remove">Bottom</p>
              </div>
          </div>
          <h3 class="uk-margin-small-top mb-3">Collar Primavera</h3>
          <div class="uk-flex uk-flex-center mb-3">
            <h3 class="dandelion mx-1 sinOferta">$500</h3><h3 class="doveGrey mx-1">$250</h3>
          </div>

        </div>
      </div>
      @foreach($products as $product)
        <div class="uk-text-center">
          <div class="product">

            <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
              <a href="/producto/{{$product->id}}">
                <img src="/storage/{{$product->images->first()->path}}" alt="">
                @if(count($product->images)>1)
                  <img class="uk-transition-scale-up uk-position-cover" src="/storage/{{$product->images[1]->path}}" alt="">
                @endif
                <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                    <p class="uk-h4 uk-margin-remove">Bottom</p>
                </div>
            </div>
            <h3 class="uk-margin-small-top mb-3">{{$product->name}}</h3>
            <div class="uk-flex uk-flex-center mb-3">
              <h3 class="dandelion mx-1 sinOferta">{{$product->price}}</h3><h3 class="doveGrey mx-1">{{$product->price - ($product->price*$product->discount/100)}}</h3>
              </a>
            </div>

          </div>
        </div>
      @endforeach

    </div>


  </section>

@endsection
