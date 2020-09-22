@extends('layouts.plantilla')
@section('titulo')
Control de precios
@endsection
@section('main')

  <!-- Vista de control de precios -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Control de precios</span></li>
  </ul>


  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Control de <span class="bold blueSlate">Precios</span></h2>

    <div class="uk-card uk-card-default uk-card-body uk-margin-small mb-5 p-md-5">

      <form class="form w-50 m-auto" action="/updateprices" method="post">
        @csrf
        <div>
          <label for="criterio_busqueda">Selecione el criterio de búsqueda</label>
          <div>
            <select id="criterio_busqueda" class="form-control-checkout" name="criterio_busqueda">
              <option value="">Seleccione</option>
              <option value="category">Categoria</option>
              <option value="material">Material</option>
              <option value="brand">Marca</option>
            </select>
          </div>
        </div>
        
        <br>

        <div id="categoryDiv" hidden>
          <label for="categoria">Seleccione la categoria de los productos a modificar</label>
          <div>
            <select id="categoria" class="form-control-checkout" name="category_id">
              <option value="">Todas las categorias</option>
              @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div id="materialDiv" hidden>
          <label for="material">Seleccione el material de los productos a modificar</label>
          <div>
            <select id="material" class="form-control-checkout" name="material_id">
              <option value="">Todos las materiales</option>
              @foreach ($materials as $material)
                <option value="{{$material->id}}">{{$material->name}}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div id="brandDiv" hidden>
          <label for="">Seleccione la marca de los productos a modificar</label>
          <div>
            <select class="form-control-checkout" name="brand_id">
              <option value="">Todas las marcas</option>
              @foreach ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <br>

        <h3 class="regular text-center pb-3">Elija una <span class="bold blueSlate">acción</span></h3>

        <div class="">
          <div class="">
            <label for="aumento">Aumento</label>
            <input id="aumento" type="radio" name="operacion" value="sum">
          </div>
          <div class="">
            <label for="descuento">Descuento</label>
            <input id="descuento" type="radio" name="operacion" value="rest">
          </div>
        </div>

        <label for="porcentaje">Porcentaje</label>
        <input id="porcentaje" class="form-control-checkout pr-2" type="number" min="0" name="percentage" value="">
        <div id="error_button_div" class="row"></div>
        <br>
        <button id="prices_button" class="btn bg-blueSlate" type="submit" name="">Enviar</button>

      </form>

    </div>

      {{-- Tabla de datos --}}
      <div class="table-responsive-md">
        <table class="table">
          <thead class="">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Precio</th>
              <th scope="col">Categoria</th>
              <th scope="col">Descuento</th>
              <th scope="col">Marca</th>
              <th scope="col">Material</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <th scope="row">{{$product->name}}</th>
                <td>{{getRealPrice($product)}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->discount}}</td>
                <td>{{($product->brand) ? $product->brand->name : 'Sin Marca'}}</td>
                <td>{{($product->material) ? $product->material->name : 'Sin Material'}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Paginador --}}
      {{$products->links()}}
    </div>

  <script src="/js/price_controller.js" charset="utf-8"></script>
@endsection
