  {{-- @php
  dd($errors);
@endphp --}}
@extends('layouts.plantilla')
@section('titulo')
Editar Perfil
@endsection
@section('main')

  <!-- Vista de edicion del Usuario-->

  <ul class="uk-breadcrumb px-4 pt-2">
    <li><a href="/">Inicio</a></li>
    <li><a href="/profile">Ver perfil</a></li>
    <li><span class="dandelion">Editar Perfil</span></li>
  </ul>

  <div class="container pb-4" style="text-align: -webkit-center;">

    <h2 class="regular text-center pb-3">Editar tu <span class="bold blueSlate">Perfil</span></h2>

    <div class="uk-card uk-card-default uk-card-body uk-margin-small" style="max-width:650px;">

      <form class="text-center" action='/editar-perfil' method="post" enctype="multipart/form-data" style="text-align-last: center; text-align-last: center; display: flex; flex-direction: column; align-items: center;">
        @csrf
        @method('put')


          <div class="col-6">
            <label for="">Nombre: </label>
            <input type="text" class="form-control-checkout" name="name" value="{{ Auth::user()->name }} ">
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <br>

          <div class="col-6">
            <label for="">Email: </label><br>
            <input type="text" class="form-control-checkout" name="email" value="{{ Auth::user()->email }}">
            @error('email')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <br>


          {{-- <div class="col-6">
            <label for="">Ingrese su contraseña actual: *</label><br>
            <input type="password" class="form-control-checkout" name="old_password" value="" placeholder="Ingresa tu Contraseña">
            @error('password')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <br> --}}

          <div class="col-6">
            <label for="">Nueva contraseña: </label><br>
            <input id="password" type="password" class="form-control-checkout" name="password" value="" placeholder="Ingresa tu nueva password">
            @error('password')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>

          <br>

          {{-- <div class="col-6">
            <label for="">Repite su nueva contraseña: *</label><br>
            <input id="repeat_password"type="password" class="form-control-checkout" name="" value="" placeholder="Ingresa tu nueva password">
            @error('password')
              <p class="errorForm">{{ $message }}</p>
            @enderror
          </div>
          <div class="">
            <p id="errorPassword" hidden style="color:red;"></p>
          </div> --}}

          <br>

          <div class="col-6">
            <input style="width:190px;" type="submit" class="btn bg-ashBlue" name="" value="Editar Usuario">
            <br><br>
            <a style="width:190px;" class="btn bg-dandelion" href="#confirm" uk-toggle>Eliminar Usuario</a>
          </div>

      </form>

      @include('partials.confirm',['url'=>'/borrar-perfil', 'message'=>'Seguro quiere eliminar el usuario?'])


    </div>

  </div>

{{-- <script type="text/javascript">
  window.addEventListener('load',function(){
    const password = document.getElementById('password')
    const Rpassword = document.getElementById('repeat_password')
    const errorPassword = document.getElementById('errorPassword')
    password.addEventListener('blur',function(){
      errorPassword.innerHTML = ""
      errorPassword.setAttribute('hidden','true');
      if(!Rpassword.value=="" && password.value != Rpassword.value){
        errorPassword.removeAttribute('hidden');
        errorPassword.innerHTML = "Tus contraseñas no coinciden!"
      }
    })
    Rpassword.addEventListener('blur',function(){
      errorPassword.innerHTML = ""
      errorPassword.setAttribute('hidden','true');
      if(!password.value=="" && password.value != Rpassword.value){
        errorPassword.removeAttribute('hidden');
        errorPassword.innerHTML = "Tus contraseñas no coinciden!"
      }
    })
  })
</script> --}}
@endsection
