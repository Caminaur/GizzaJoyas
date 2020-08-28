@extends('layouts.plantilla')
@section('titulo')
Edit materials
@endsection
@section('main')

  <!-- Vista de editar materiales -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/controlpanel">Volver</a></li>
    <li><span class="dandelion">Editar Material</span></li>
  </ul>

  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Agregar un <span class="bold blueSlate">Material</span></h2>

    <form class="p-4" action='/addmaterial' method="post" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
          <input type="text" class="form-control-checkout" name="name" placeholder="Nombre de la material" value="">
          @error('name')
            <p class="errorForm">{{ $message }}</p>
          @enderror
          <button class="btn bg-blueSlate" type="submit" name="button">Agregar</button>
        </div>
    </form>


    <h2 class="regular text-center pb-3">Editar un <span class="bold blueSlate">Material</span></h2>

    @foreach ($materials as $material)
      <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
        <form class="p-4" action='/editmaterial' method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')
            <div class="form-group">          
              <input type="text" hidden name="material_id" value="{{$material->id}}">
              <input type="text" class="form-control-checkout" name="name" value="{{$material->name}}">
              @error('name')
                <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>
            <button class="btn bg-ashBlue" type="submit" name="button">Editar</button>
        </form>

        <a class="btn bg-dandelion"  href="#confirm{{$material->id}}" uk-toggle>Eliminar</a>
        @include('partials.confirm',['url'=>"/deletematerial", 'message'=>"Seguro quiere eliminar el material '{$material->name}'?", 'name'=>'material_id', 'id'=>"{$material->id}"])
      </div>
    @endforeach

  </div>
@endsection
