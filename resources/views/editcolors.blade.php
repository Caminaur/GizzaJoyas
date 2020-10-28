@extends('layouts.plantilla')
@section('titulo')
Edit Color
@endsection
@section('main')

  <!-- Vista de editar coloro -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/adminpanel">Volver</a></li>
    <li><span class="dandelion">Editar Color</span></li>
  </ul>

  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Agregar un <span class="bold blueSlate">Color</span></h2>

    <form action='/addcolor' method="post" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
          <input type="text" class="form-control-checkout" name="name" placeholder="Nombre del Color" value="">
          @error('name')
            <p class="errorForm">{{ $message }}</p>
          @enderror
          <button class="btn bg-blueSlate" type="submit" name="button">Agregar</button>
        </div>
    </form>

    <h2 class="regular text-center pb-3">Editar un <span class="bold blueSlate">Color</span></h2>

    @foreach ($colors as $color)
      <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
        <form class="p-4" action='/editcolor' method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')
            <div class="form-group">
              <input class="form-control-checkout" type="text" hidden name="color_id" value="{{$color->id}}">
              <input class="form-control-checkout" type="text" class="form-control" name="name" value="{{$color->name}}">
              @error('name')
                <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>
            <button class="btn bg-ashBlue" type="submit" name="button">Editar</button>
        </form>

        <a class="btn bg-dandelion"  href="#confirm{{$color->id}}" uk-toggle>Eliminar</a>
        @include('partials.confirm',['url'=>"/deletematerial", 'message'=>"Seguro quiere eliminar el Color {$color->name}?", 'name'=>'color_id', 'id'=>"{$color->id}"])
      </div>
    @endforeach

  </div>
@endsection
