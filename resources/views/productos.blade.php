@extends('layouts.plantilla')
@section('titulo')
Productos
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li><a href="">Categorias</a></li>
    @foreach ($categories as $category)
      <li><span class="dandelion">{{$category->name}}</span></li>
    @endforeach
  </ul>

  <h1 class="medium text-center p-4">Nuestros Productos</h1>

  <section id="productos" class="container mb-5">

    <div class="uk-child-width-1-2 uk-child-width-1-3@m" uk-grid uk-height-match="target: > div > .product"> {{-- para igualar la altura use este atributo match--}}
      @foreach ($products as $product)
          <div>

            <div class="product uk-text-center pb-4">

              <div class="uk-inline-clip uk-transition-toggle inside" tabindex="0">
                <a href="/producto/{{$product->id}}">
                  <img class="producto" src="/storage/{{$product->images->first()->path}}" alt="">
                  @if (count($product->images)>1)
                    <img class="uk-transition-scale-up uk-position-cover" src="/storage/{{$product->images[1]->path}}" alt="">
                  @endif
                  {{-- <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
                  <p class="uk-h4 uk-margin-remove" style="color:white;">Ver más</p>
                </div> --}}

                {{-- Si el producto tiene descuento creo un cartelito --}}
                @if ($product->discount)
                  <div class="onSale-label">
                    <ul>
                      <li class="sale"><h4>{{$product->discount}}% off</h4></li>
                    </ul>
                  </div>
                @endif

                {{-- iconos de favoritos/carrito sobre cada producto --}}
                <div class="uk-visible-toggle icons-product" tabindex="-1">
                  <div class="uk-flex-center pt-3" uk-grid>
                    <div class="uk-width-auto">
                      <ul class="uk-iconnav">
                        <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/favoritos"><i class="hvr-icon far fa-heart"></i></a></li>
                        <li><a class="rounded-icon ico hvr-icon-rotate" href="/cart"><span class="hvr-icon" uk-icon="icon: cart"></span></a></li>
                        @if (Auth::user())
                          {{-- Si sos admin ves iconos de edicion/eliminacion --}}
                          @if (Auth::user()->isAdmin == true)
                            <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/editproduct/{{$product->id}}"><span class="hvr-icon" uk-icon="icon: pencil"></span></a></li>
                            <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/copy"><span class="hvr-icon" uk-icon="icon: copy"></span></a></li>
                            <li><a class="rounded-icon ico hvr-icon-pulse-shrink" href="/deleteproduct/{{$product->id}}"><span class="hvr-icon" uk-icon="icon: trash"></span></a></li>
                          @endif
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>

              </a>
            </div>

            {{-- Nombre del producto --}}
            <h3 class="product-desc uk-margin-small-top mb-3">{{$product->name}}</h3>

            {{-- Si el producto se agrego hace 20 dias o antes aparecera como NUEVO --}}
            <div class="new-label">
              <ul>
                <li class="new"><h4>Nuevo</h4></li>
              </ul>
            </div>

            {{-- Precio del producto --}}
            <div class="uk-flex uk-flex-center mb-3">
              {{-- Con descuento--}}
              @if ($product->onSale)
              <h3 class="dandelion mx-1 sinOferta">${{$product->price}}</h3>
              <h3 class="doveGrey mx-1">${{$product->price - $product->price* $product->discount/100}}</h3>
              @else
                {{-- Sin descuento (precio de lista) --}}
                <h3 class="doveGrey mx-1">${{$product->price}}</h3>
              @endif
            </div>

            {{-- Si no hay stock muestro este mensaje --}}
            <a class="btn border-ashBlue" href="#">Solicitar stock</a>

          </div>
        </div>
      @endforeach
    </div>



  </section>

@endsection
