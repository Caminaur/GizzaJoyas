{{-- @php
  dd($errors);
@endphp --}}
@extends('layouts.plantilla')
@section('titulo')
Editar Perfil
@endsection
@section('main')
  <div class="container m-5 p-4">
    <h2 style="text-align:left"class="ml-3 mb-5">Editar Perfil</h2>

        <!-- Vista de edicion del Usuario-->
    <form class="text-center" action='/editar-perfil' method="post" enctype="multipart/form-data" style="text-align-last: center;">
      @csrf
      @method('put')


        <div class="col-6">
          <label for="">Nombre: *</label>
          <input type="text" class="form-control-checkout" name="name" value="{{ Auth::user()->name }} ">
          @error('name')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>


      <br>


        <div class="col-6">
          <label for="">Email: *</label><br>
          <input type="text" class="form-control-checkout" name="email" value="{{ Auth::user()->email }}">
          @error('email')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>

        <br>
        <div class="col-6">
          <label for="">Ingrese su contraseña actual: *</label><br>
          <input type="password" class="form-control-checkout" name="old_password" value="" placeholder="Ingresa tu Contraseña">
          @error('password')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>
        <br>

        <div class="col-6">
          <label for="">Nueva contraseña: *</label><br>
          <input id="password"type="password" class="form-control-checkout" name="new_password" value="" placeholder="Ingresa tu nueva password">
          @error('password')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>
        <br>
        <div class="col-6">
          <label for="">Repite su nueva contraseña: *</label><br>
          <input id="repeat_password"type="password" class="form-control-checkout" name="" value="" placeholder="Ingresa tu nueva password">
          @error('password')
            <p class="errorForm">{{ $message }}</p>
          @enderror
        </div>
        <div class="">
          <p id="errorPassword" hidden style="color:red;"class=""></p>
        </div>

      <br>


        <div class="form-group col-6">
          <input type="submit" class="btn border-ashBlue" name="" value="Editar Usuario">
        </div>
    </form>

    <form class="" action="/deleteUser" method="post">
      @csrf
      <div class="form-group col-6">
      <input type="submit" class="btn border-dandelion" name="" value="Eliminar Usuario">
    </form>
      </div>
      <div class="">
      <a href="/profile" class="centrado">Volver atras</a>
      </div>


  </div>

<script type="text/javascript">
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
</script>
@endsection
