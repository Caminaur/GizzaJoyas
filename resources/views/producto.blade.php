@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')

  <ul class="uk-breadcrumb  px-4 py-2">
    <li><a href="/">Inicio</a></li>
    <li><a href="/{{$product->category->name}}">{{$product->category->name}}</a></li>
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
            						<a href="/storage/{{$product->images[$i]->path}}">
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
              <h2 class="blueSlate">${{$product->price - ($product->price*$product->discount/100)}}</h2>
              <h3 style="text-align:justify;">{{ $product->description }}</h3>
              <h3>Estas viendo <a href="/{{ $product->category->name }}" class="blueSlate">{{$product->category->name}}</span></h3>
                @foreach ($product->tags as $tag)
                  <a href="#" class="tag">{{ $tag->name }}</a>
                @endforeach
                <a href="" class="tag">Garantia</a>
              </div>

              <div class="detalles-compra pt-3">
                <div class="def-number-input number-input safari_only d-inline-flex">
                  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                  <input id="quantity" class="quantity" min="0" name="quantity" value="1" type="number">
                  <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                </div>
                <select class="size" name="size_id">
                  @foreach ($product->category->sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                  @endforeach
                </select>
                <br>
                {{-- Si hay stock que aparezca el boton comprar --}}
                <button class="btn bg-dandelion" type="submit">Comprar</button>
                {{-- Si no hay stock muestro este mensaje --}}
                {{-- <a class="btn border-ashBlue mt-4" href="#">Solicitar stock</a> --}}

              </div>
          </form>

        <div class="share py-4">
          <h5>Te gusta el producto? compartilo con tus amigos en las redes</h5>
          <!-- AddToAny BEGIN -->
          <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
          {{-- <a class="a2a_dd" href="https://www.addtoany.com/share"></a> --}}
          <a class="a2a_button_facebook"></a>
          <a class="a2a_button_whatsapp"></a>
          <a class="a2a_button_telegram"></a>
          <a class="a2a_button_facebook_messenger"></a>
          </div>
          <script async src="https://static.addtoany.com/menu/page.js"></script>
          <!-- AddToAny END -->
        </div>

      </section>


    </section>

    <section class="productos-relacionados py-4">
      <h2 class="regular text-center pb-3">Productos <span class="bold blueSlate">Relacionados</span></h2>

      <div uk-slider>

    <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-height-match="target: > ul > li > .uk-card">

        <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid">
            <li>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="/img/anillos.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                          <h3 class="product-desc text-center">Collar Primavera</h3>
                        <div class="uk-flex uk-flex-center mb-3">
                          <h3 class="dandelion mx-1 sinOferta">$500</h3><h3 class="doveGrey mx-1">$250</h3>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="/img/anillos.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Headline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="/img/anillos.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Headline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="/img/anillos.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Headline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="/img/anillos.jpg" alt="">
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">Headline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </li>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

    </div>

    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>
    </section>


  </div>
@endsection
