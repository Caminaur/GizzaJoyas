@extends('layouts.plantilla')
@section('titulo')
Buscar producto
@endsection
@section('css')
productos
@endsection('css')
@section('main')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Busqueda de Productos</h1>

          <form class="search-bar" action="/searchproduct/searchName" method="get">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar por nombre" name="name">

              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-ligth"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>

          <form class="search-bar" action="/searchproduct/searchCategoryId" method="get">
            <div class="input-group">
              <select class="form-control" name="category_id">
                <option value="">Seleccione una categoria</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-ligth">Buscar</button>
              </div>
            </div>
          </form>

          <form class="search-bar" action="/searchproduct/searchBrandId" method="get">
            <div class="input-group">
              {{-- <input type="text" class="form-control" placeholder="Buscar por marca" name="brand"> --}}
              <select class="form-control" name="brand">
                <option value="">Seleccione una marca</option>
                @foreach ($brands as $brandonStark)
                  <option value="{{$brandonStark->id}}">{{$brandonStark->name}}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-ligth"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>

        <div class="form-control">
          <a href="/importexcel">Importar Excel de productos</a>
        </div>

        <div class="">
          <form class="" action="/updateprices" method="post">
            @csrf
            <div class="">
              <label for="">Selecione el criterio de busqueda</label>
              <div class="">
                <label for="">Categoria</label>
                <input id="radioCategory" type="radio" name="criterioDeBusqueda" value="category_id">
              </div>
              <div class="">
                <label for="">Material</label>
                <input id="radioMaterial" type="radio" name="criterioDeBusqueda" value="material_id">
              </div>
              <div class="">
                <label for="">Marca</label>
                <input id="radioBrand" type="radio" name="criterioDeBusqueda" value="brand_id">
              </div>
            </div>
            <div id="categoryDiv" class="" hidden>
              <label for="">Seleccione la categoria de los productos a modificar</label>
              <select class="" name="category_id">
                <option value="">Todas las categorias</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div id="materialDiv" class="" hidden>
              <label for="">Seleccione el material de los productos a modificar</label>
              <select class="" name="material_id">
                <option value="">Todos las materiales</option>
                @foreach ($materials as $material)
                  <option value="{{$material->id}}">{{$material->name}}</option>
                @endforeach
              </select>
            </div>
            <div id="brandDiv" class="" hidden>
              <label for="">Seleccione la marca de los productos a modificar</label>
              <select class="" name="brand_id">
                <option value="">Todas las marcas</option>
                @foreach ($brands as $brand)
                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="">
              <label for="">Aumento</label>
              <input type="radio" name="operacion" value="sum">
              <label for="">Descuento</label>
              <input type="radio" name="operacion" value="rest">
            </div>
            <label for="">Porcentaje</label>
            <input type="number" min="0" name="percentage" value="">
            <button class="btn-secondary btn"type="submit" name="">Enviar</button>
          </form>
        </div>
      </div>

    </div>
    <section class="productos">
        <div class="row">
          @foreach ($products as $product)
            <div class="padding col-6 col-md-4 col-lg-3">
              <div class="">
                {{-- Al id del carousel le concateno el id del producto que va a ser unico e irrepetible para que al cambiar la imagen
                de un carousel no cambie la de todos. --}}
                <div id="carouselExampleFade{{$product->id}}" class="carousel slide " data-ride="carousel" data-interval="false">
                  <div class="carousel-inner">
                    {{-- Este es el div ACTIVE del carousel, el que va a mostrarse al iniciar. ES OBLIGATORIO QUE EXISTA
                    para que fincione el carousel. Coloco la ruta de la imagen principal del producto, es decir, la de la posicion 0 --}}
                    <div class="carousel-item active">
                        <a href="/producto/{{$product->id}}"><img src="/{{$product->images->first()->path}}" class="d-block w-100" alt="..."> {{-- ALTERNATIVA{{$product->images[0]->path}} --}}
                    </div>
                    {{-- Luego, debo crear un carousel item por imagen del producto por lo tanto recorro las imagenes del mismo y busco sus rutas --}}
                    @foreach ($product->images as $image)
                      {{-- @dd($image->path,$images->first()->path) --}}
                      @if ($image->path != $product->images->first()->path)
                        <div class="carousel-item">
                          <a href="/producto/{{$product->id}}"><img src="/storage/{{$image->path}}" class="d-block w-100" alt="...">
                        </div>
                      @endif

                    @endforeach
                  </div>

                  {{-- Aqui empiezan los botones de previous y next, debo ponerles como href el id de cada producto
                  ya que debe ser distinto para cada carousel. Ver explicacion linea 21 --}}
                  <a class="carousel-control-prev" href="#carouselExampleFade{{$product->id}}" role="button" data-slide="prev">
                    <span><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleFade{{$product->id}}" role="button" data-slide="next">
                  <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                {{-- @if ($product->brand->name!=null)
                  <p class="marca">{{$product->brand->name}}</p>
                @endif --}}
                <p class="nombre wow fadeInDown">{{$product->name}}</p>
                @if($product->onSale==true && isset($product->discount))
                  @php
                    $onSalePrice = $product->price - $product->price/100*$product->discount; // precio * descuento / 100
                  @endphp
                  <span class="descuento">{{$product->discount}}% off</span> <!-- Pone un cartelito de descuento sobre la imagen del producto-->
                  <span class="precioAnterior">${{$product->price}}</span> <!-- Muestra precio anterior tachado -->
                  <span class="precio">${{$onSalePrice}}</span><p></p> <!-- Muestra el precio con el descuento incluido -->
                @else
                    <p class="precio">${{$product->price}}</p>
                @endif
                @if (Auth::user())
                  @if (Auth::user()->isAdmin == true)
                    <a class="ordenar" href="/editproduct/{{$product->id}}">Editar Producto</a>
                  @endif
                @endif
                <a class="ordenar" href="/">Ordenar!  <ion-icon name="cart"></ion-icon></a>
              </div>
            </div>
          @endforeach
        </div>
        {{$products->links()}}
      </section>
  </div>
  <script src="/js/searchproduct.js" charset="utf-8"></script>
@endsection
