@extends('layouts.plantilla')
@section('titulo')
Edit Gender
@endsection
@section('main')

  <!-- Vista de editar Género -->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/adminpanel">Volver</a></li>
    <li><span class="dandelion">Editar Género</span></li>
  </ul>

  <div class="container text-center pb-4">

    <h2 class="regular text-center pb-3">Agregar un <span class="bold blueSlate">Género</span></h2>

    <form action='/addgender' method="post" enctype="multipart/form-data">
      {{csrf_field()}}
        <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
          <input type="text" class="form-control-checkout" name="name" placeholder="Nombre del Género" value="">
          @error('name')
            <p class="errorForm">{{ $message }}</p>
          @enderror
          <button class="btn bg-blueSlate" type="submit" name="button">Agregar</button>
        </div>
    </form>

    <h2 class="regular text-center pb-3">Editar un <span class="bold blueSlate">Género</span></h2>

    @foreach ($genders as $gender)
      <div class="uk-card uk-card-default uk-card-body uk-margin-small my-4" style='max-width: 500px; margin: 0 auto;'>
        <form class="p-4" action='/editgender' method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')
            <div class="form-group">
              <input class="form-control-checkout" type="text" hidden name="gender_id" value="{{$gender->id}}">
              <input class="form-control-checkout" type="text" class="form-control" name="name" value="{{$gender->name}}">
              @error('name')
                <p class="errorForm">{{ $message }}</p>
              @enderror
            </div>
            <button class="btn bg-ashBlue" type="submit" name="button">Editar</button>
        </form>

        <a class="btn bg-dandelion"  href="#confirm{{$gender->id}}" uk-toggle>Eliminar</a>
        @include('partials.confirm',['url'=>"/deletematerial", 'message'=>"Seguro quiere eliminar el género {$gender->name}?", 'name'=>'gender_id', 'id'=>"{$gender->id}"])
      </div>
    @endforeach

  </div>
@endsection
