@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')

  <ul class="uk-breadcrumb  px-4 py-2">
    <li><a href="/">Inicio</a></li>
    <li><a href="/productos/categoria/{{$category_name}}">{{$category->name}}</a></li>
    <li><span class="dandelion">{{$product->name}}</span></li>
  </ul>

  <div class="uk-background-muted p-4">

    <section class="producto pb-4">

      <section class="imagenes-producto mb-4">

    		<div>
          <div>
          	{{-- <div class="uk-card uk-card-body uk-card-default"> --}}
          		<div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="min-height: 350; max-height: 350">
                <ul class="uk-slideshow-items" uk-lightbox>
                  @for ($i = 0; $i < count($product->images); $i++)
                    <li>
                      <a href="/storage/{{$product->images[$i]->path}}" data-caption="{{$i}}">
                        <img class="imagenes-producto {{-- Si no hay stock poner clase opacity --}}" src="/storage/{{$product->images[$i]->path}}" alt="" uk-cover>
                      </a>
                    </li>
                  @endfor
          			</ul>

          			<div class="uk-position-bottom-center uk-position-small">
                	<ul class="uk-thumbnav align-items-center">
                    @for ($i = 0; $i < count($product->images); $i++)
                      <li class="" uk-slideshow-item="{{ $i }}">
            						<a href="{{$product->images[$i]->path}}">
            							<img src="/storage/{{$product->images[$i]->path}}" width="60">
            						</a>
            					</li>
                    @endfor
          				</ul>
              	</div>
          		</div>
          	{{-- </div> --}}
          </div>
  	    </div>


      </section>

      <section class="informacion">
        <div class="detalles-producto">
          <form class="" action="/cart" method="post">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <h1 class="bold">{{ $product->name }}</h1>

              @if ($product->onSale)
                <h3 class="dandelion mx-1 sinOferta">${{number_format($product->price, 0, '.', '.')}}</h3>
              @endif

              <h2 class="blueSlate">${{number_format((getRealPrice($product)), 0, '.', '.')}}</h2>
              <h3 style="text-align:justify;">{{ $product->description }}</h3>
              <h3>Estas viendo <a href="/{{ $product->category->name }}" class="blueSlate">{{$product->category->name}}</span></h3>
                @foreach ($product->tags as $tag)
                  <a href="#" class="tag">{{ $tag->name }}</a>
                @endforeach
                <a href="" class="tag">Garantia</a>
              </div>

              <div class="detalles-compra pt-3">
                <div class="def-number-input number-input safari_only d-inline-flex">
                  <button name='cantidad' type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus" @if (!hasStock($product)) disabled='true'@endif></button>
                  <input id="quantity" class="quantity" min="0" name="quantity" type="number" @if (!hasStock($product)) disabled='true' value="0"  @else value="1" @endif>
                  <button name='cantidad' type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" @if (!hasStock($product)) disabled='true'@endif></button>
                </div>
                <select id="select_size" class="size" name="size_id">
                  {{-- En caso de que no haya stock de ningun talle, le agregamos esta opcion
                  ya que se ve afectada la estetica, por esto esta opcion va a ser la unica
                  habilitada en este caso --}}
                  @if (!hasStock($product))
                    <option >--</option>
                  @endif
                  {{-- Recorremos todos los stocks del producto --}}
                  @foreach ($product->stocks as $stock)
                    {{-- En caso de que no haya stock de este talle en particular lo deshabilitamos y le cambiamos
                    un poco el estilo --}}
                    @if (!sizeHasStock($stock))
                      <option style="color:red;" value="{{ $stock->size->id }}" disabled>{{ $stock->size->name }} Sin stock!</option>
                    @else
                      <option name="stocks" class="{{$stock->quantity}}" value="{{ $stock->size->id }}">{{ $stock->size->name }}</option>
                    @endif
                  @endforeach
                </select>
                <br>
                {{-- Guardamos los stocks de los talles disponibles --}}
                @foreach ($product->stocks as $stock)
                  @php
                    $cantidad = $stock->quantity;
                  @endphp
                  @if (isset(Auth::user()->carts))
                    @foreach (Auth::user()->carts as $cart)
                      @if ($cart->size_id==$stock->size_id)
                        @php
                          $cantidad = $cantidad - $cart->quantity;
                        @endphp
                      @endif
                    @endforeach
                  @endif
                  <input type="hidden" name="{{$stock->size->id}}" value="{{$cantidad}}">
                @endforeach
                <p style="color:red;"hidden id="errorMessage"></p>
                @if (hasStock($product))
                  {{-- Si hay stock que aparezca el boton comprar --}}
                  <button id="comprar_button" class="btn bg-dandelion" type="submit">Comprar</button>
                @else
                  {{-- Si no hay stock muestro este mensaje --}}
                  <a class="btn border-ashBlue"
                  href="https://api.whatsapp.com/send?phone=5491124821816&text=Hola, estoy contactandolos desde *Gizza Joyas y Relojes Tienda Online* para pedirles stock del siguiente producto: @if(isset($product->brand->name)) _Marca:_ {{$product->brand->name}}@endif, _Nombre:_ {{$product->name}}, @if(isset($product->model)) _Modelo:_ {{$product->model}} @endif"
                  >Solicitar stock</a>
                @endif

              </div>
          </form>


          <ul class="uk-iconnav mt-3">
            <li>
              <input id="product{{$product->id}}" type="hidden" name="" value="{{$product->id}}">
              <a id="add_to_favourite" class="rounded-icon ico favourite_icon_ajax" href="/live_search/add_favourite_from_product">
                {{-- Si el usuario esta logueado y tiene como favorito este producto, mostrar el corazon lleno                 --}}
                @if (Auth::user() && isFavourite($product, Auth::user()))
                  <div class="">
                    <span id="heart_icon" class="hvr-pulse-shrink isFavourite" uk-icon="icon: heart;"></span>
                  </div>
                @else
                  <div class="">
                    <span id="heart_icon" class="hvr-pulse-shrink" uk-icon="icon: heart;"></span>
                  </div>
                @endif

              </a>
              <input type="hidden" name="" value="{{$product->id}}">
            </li>
            <li><a class="rounded-icon ico" href="/cart"><span class="hvr-rotate" uk-icon="icon: cart"></span></a></li>
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



        <div class="share py-4">
          <h5>Te gusta el producto? compartilo con tus amigos en las redes</h5>
          <!-- AddToAny BEGIN -->
          <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
          {{-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> --}}
          <a href="https://www.facebook.com/gizza.joyas"><img src="https://static.addtoany.com/buttons/facebook.svg" width="32" height="32" style="background-color:royalblue"></a>
          <a class="a2a_button_whatsapp"></a>
          </div>
          <script async src="https://static.addtoany.com/menu/page.js"></script>
          <!-- AddToAny END -->
        </div>

      </section>


    </section>
    @if (count($array_chunks)>1)
      <section class="productos-relacionados py-4">
      <h2 class="regular text-center pb-3">Productos <span class="bold blueSlate">Relacionados</span></h2>

      <div uk-slider>
        {{-- uk-slider="sets: true" Para pasar de a varios items --}}

        <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-height-match="target: > ul > li > .uk-card">

          <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid">
            @foreach ($array_chunks as $related)
              @if ($related->id!=$product->id)
                <li>
                  <div class="uk-card uk-card-default">
                    <div style="text-align: center;" class="uk-card-media-top">
                      <a href="/producto/{{$related->id}}">
                        <img style="width: 300px; height: 300px; object-fit: cover;" src="/storage/{{$related->images[0]->path}}" alt="">
                      </a>
                    </div>
                    <div class="uk-card-body text-center">
                      <h3 class="product-desc">{{$related->name}}</h3>
                      <h3>{{$related->category->name}}</h3>
                      {{-- <div class="uk-flex uk-flex-center mb-3"> --}}
                        @if ($related->onSale)
                          <h3 class="dandelion mx-1 sinOferta">${{number_format($related->price, 0, '.', '.')}}</h3>
                          <h3 class="blueSlate mx-1">${{number_format((getRealPrice($related)), 0, '.', '.')}}</h3>
                        @else
                          {{-- Sin descuento (precio de lista) --}}
                          <h3 class="blueSlate mx-1">${{number_format($related->price, 0, '.', '.')}}</h3>
                        @endif
                      {{-- </div> --}}
                    </div>
                  </div>
                </li>
              @endif
            @endforeach
          </ul>

          <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
          <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

        </div>

      <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

      </div>
    </section>
    @endif


  </div>
  <script src="/js/producto_favorito.js" charset="utf-8"></script>
  <script src="/js/producto.js" charset="utf-8"></script>
@endsection
