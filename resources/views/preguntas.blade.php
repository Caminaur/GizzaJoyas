@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li><a href="">Inicio</a></li>
    <li><span class="dandelion">Preguntas Frecuentes</span></li>
  </ul>

  <div class="uk-background-muted p-4">


    <section>

      <a class="w-100 text-left hvr-icon-down uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple1; animation:  uk-animation-slide-left, uk-animation-slide-bottom">Garantia <i class="hvr-icon fas fa-chevron-down"></i></a>
      <div id="toggle-animation-multiple1" class="uk-card uk-card-default uk-card-body uk-margin-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
      <br>
      <a class="w-100 text-left hvr-icon-down uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple2; animation:  uk-animation-slide-left, uk-animation-slide-bottom">Garantia <i class="hvr-icon fas fa-chevron-down"></i></a>
      <div id="toggle-animation-multiple2" class="uk-card uk-card-default uk-card-body uk-margin-small">Animation</div>
      <br>
      <a class="w-100 text-left hvr-icon-down uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple3; animation:  uk-animation-slide-left, uk-animation-slide-bottom">Garantia <i class="hvr-icon fas fa-chevron-down"></i></a>
      <div id="toggle-animation-multiple3" class="uk-card uk-card-default uk-card-body uk-margin-small">Animation</div>
      <br>

    </section>

  </div>

@endsection
