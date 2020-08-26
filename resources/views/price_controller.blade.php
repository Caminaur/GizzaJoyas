@extends('layouts.plantilla')
@section('titulo')
Panel de Control
@endsection
@section('main')

  <div class="container text-center my-4">
      <div class="page-header mb-4">
        <h1>Gestion de precios</h1>
      </div>
      <div class="">
        <form class="form" action="/updateprices" method="post">
          @csrf
          <div class="row">
            <div class="col-3"></div>
            <label class="col-3" for="">Selecione el criterio de busqueda</label>
            <div class="col-3">
              <select id="criterio_busqueda" class="" name="criterio_busqueda">
                <option value="">Seleccione</option>
                <option value="category">Categoria</option>
                <option value="material">Material</option>
                <option value="brand">Marca</option>
              </select>
            </div>
            <div class="col-3"></div>
          </div>
          <div id="categoryDiv" class="row" hidden>
            <div class="col-3"></div>
            <div class="col-3">
              <label for="">Seleccione la categoria de los productos a modificar</label>
            </div>
            <div class="col-3">
              <select class="" name="category_id">
                <option value="">Todas las categorias</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-3"></div>
          </div>
          <div id="materialDiv" class="row" hidden>
            <div class="col-3"></div>
            <div class="col-3">
            <label for="">Seleccione el material de los productos a modificar</label>
            </div>
            <div class="col-3">
            <select class="" name="material_id">
              <option value="">Todos las materiales</option>
              @foreach ($materials as $material)
                <option value="{{$material->id}}">{{$material->name}}</option>
              @endforeach
            </select>
            </div>
            <div class="col-3"></div>
          </div>
          <div id="brandDiv" class="row" hidden>
            <div class="col-3"></div>
            <div class="col-3">
            <label for="">Seleccione la marca de los productos a modificar</label>
            </div>
            <div class="col-3">
            <select class="" name="brand_id">
              <option value="">Todas las marcas</option>
              @foreach ($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
              @endforeach
            </select>
            </div>
            <div class="col-3"></div>
          </div>
      </div>
          <h2>Elija la accion</h2>
          <div class="">
            <label for="">Aumento</label>
            <input type="radio" name="operacion" value="sum">
            <label for="">Descuento</label>
            <input type="radio" name="operacion" value="rest">
          </div>
          <label for="">Porcentaje</label>
          <input type="number" min="0" name="percentage" value="">
          <div id="error_button_div" class="row"></div>
          <br>
          <button id="prices_button" class="btn-secondary btn"type="submit" name="">Enviar</button>

        </form>
      </div>
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
      {{$products->links()}}
    </div>
  <script src="/js/price_controller.js" charset="utf-8"></script>
@endsection
