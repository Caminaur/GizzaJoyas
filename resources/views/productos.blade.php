@extends('layouts.plantilla')
@section('titulo')
Productos
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li>
      <a href="">Inicio</a>
    </li>
    <li>
      {{-- Si estamos observando una categoria --}}
        @if (isset($category->name))
          <span class="dandelion">
            {{$category->name}}
          </span>
        @else
          <span id='span' class="dandelion">
            Todos los productos
          </span>
        @endif

    </li>
  </ul>

  {{-- <h1 class="medium text-center p-4">Nuestros Productos</h1> --}}
  <h2 class="regular text-center pb-3">Nuestros <span class="bold blueSlate">Productos</span></h2>

  <section id="productos" class="container mb-5">

    <div id="prueba_ajax" class="uk-child-width-1-2 uk-child-width-1-3@m pb-4" uk-grid uk-height-match="target: > div > .product"> {{-- para igualar la altura use este atributo match--}}
      @forelse ($products as $product)
          <div id="productos_change">
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
                        <li class="sale">
                          <h4>{{$product->discount}}% off</h4>
                        </li>
                      </ul>
                    </div>
                  @endif
                </a>

                {{-- iconos de favoritos/carrito sobre cada producto --}}
                <div class="uk-visible-toggle icons-product" tabindex="-1">
                  <div class="uk-flex-center pt-3" uk-grid>
                    <div class="uk-width-auto">
                      <ul class="uk-iconnav justify-content-center">
                        <li>
                          <input id="product{{$product->id}}" type="hidden" name="" value="{{$product->id}}">
                          <a class="rounded-icon ico favourite_icon_ajax" href="/live_search/add_favourite">
                            {{-- Si el usuario esta logueado y tiene como favorito este producto, mostrar el corazon lleno                 --}}
                            @if (Auth::user() && isFavourite($product, Auth::user()))
                              <div class="">
                                <span class="hvr-pulse-shrink isFavourite" uk-icon="icon: heart;"></span>
                              </div>
                            @else
                              <div class="">
                                <span class="hvr-pulse-shrink" uk-icon="icon: heart;"></span>
                              </div>
                            @endif

                          </a>
                        </li>
                        <li><a class="rounded-icon ico" href="/producto/{{$product->id}}"><span class="hvr-rotate" uk-icon="icon: cart"></span></a></li>
                        @if (Auth::user())
                          {{-- Si sos admin ves iconos de edicion/eliminacion --}}
                          @if (Auth::user()->isAdmin == true)
                            <li>
                              <a class="rounded-icon ico" href="/editproduct/{{$product->id}}"><span class="hvr-pulse-shrink" uk-icon="icon: pencil"></span>
                              </a>
                            </li>
                            {{-- <li> --}}
                              {{-- <a class="rounded-icon ico" href="/copy"> --}}
                                {{-- <span class="hvr-pulse-shrink" uk-icon="icon: copy"> --}}
                                {{-- </span> --}}
                              {{-- </a> --}}
                            {{-- </li> --}}
                            <li>
                              <!-- This is a anchor toggling the modal -->
                              <a class="rounded-icon ico" href="#confirm{{$product->id}}" uk-toggle>
                                <span class="hvr-pulse-shrink" uk-icon="icon: trash"></span>
                              </a>
                            </li>
                            <!-- This is the modal -->
                            @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'id'=>$product->id, 'message'=>'Seguro quiere eliminar el producto?'])
                          @endif
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>


            </div>

            {{-- Catergoria del producto --}}
            <h3 class="product-desc uk-margin-small-top mb-3">{{$product->category->name}}</h3>

            {{-- Nombre del producto --}}
            <h3 class="product-desc uk-margin-small-top mb-3">{{$product->name}}</h3>

            {{-- Precio del producto --}}
            <div class="uk-flex uk-flex-center mb-3">
              {{-- Con descuento--}}
              @if ($product->onSale)
                <h3 class="dandelion mx-1 sinOferta">${{number_format($product->price, 0, '.', '.')}}</h3>
                <h3 class="doveGrey mx-1">${{number_format((getRealPrice($product)), 0, '.', '.')}}</h3>
              @else
                {{-- Sin descuento (precio de lista) --}}
                <h3 class="doveGrey mx-1">${{number_format($product->price, 0, '.', '.')}}</h3>
              @endif
            </div>

            {{-- Si el producto se agrego hace 20 dias o antes aparecera como NUEVO --}}
              @if (isThisNew($product->created_at))
                <div class="new-label">
                  <ul>
                    <li class="new"><h4>Nuevo</h4></li>
                  </ul>
                </div>
              @endif
            {{-- Si no hay stock muestro este mensaje --}}
            @if (!hasStock($product))
              <a class="btn border-ashBlue"
              href="https://api.whatsapp.com/send?phone=5491124821816&text=Hola, estoy contactandolos desde *Gizza Joyas y Relojes Tienda Online* para pedirles stock del siguiente producto: @if(isset($product->brand->name)) _Marca:_ {{$product->brand->name}}@endif, _Nombre:_ {{$product->name}}, @if(isset($product->model)) _Modelo:_ {{$product->model}} @endif"
              >Solicitar stock</a>
            @endif

          </div>
        </div>
      @empty
        <h3 class="regular text-center pb-3">No hay <span class="bold blueSlate">Productos Existentes</span></h3>
      @endforelse
    </div>

    <div id="paginas" class="">
      {{$products->links()}}
    </div>
  </section>
  @if (Auth::user())
    <input id="control_de_registro" type="hidden" name="" value="true">
  @else
    <input id="control_de_registro" type="hidden" name="" value="false">
  @endif


  <script src="/js/ajax_products_favourite.js" charset="utf-8"></script>
  <script src="/js/ajax_products.js" charset="utf-8"></script>
@endsection
