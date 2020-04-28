@extends('layouts.plantilla')
@section('titulo')
Recuperar Clave
@endsection
@section('main')

<div class="wrapper" style="background-color: rgb(226, 231, 235);">

  <div class="inner">
    <div class="image-holder align-self-center">
      <img src="/img/rings/recover.jpg" alt="">
      <div class="text-center mt-3">
        <i class="social fab fa-instagram"></i>
        <i class="social fab fa-whatsapp"></i>
        <i class="social fab fa-facebook-f"></i>
      </div>
    </div>



    <form method="POST" action="{{ route('password.email') }}" enctype="multipart/form-data">
      @csrf
      <h2 class="blueSlate bold text-center mb-4">RECUPERAR CLAVE</h2>

      <div class="form-wrapper">
        <input id="email" value="{{ old('name') }}" type="email"  name="email" placeholder="Dirección de correo" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus required>
        <i class="zmdi zmdi-email"></i>

        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror

      </div>

      <h5 class="blueSlate">Enviaremos un enlace a tu correo para recuperar tu clave </h5>

      <button type="submit" class="btn bg-blueSlate">Enviar
        <i class="zmdi zmdi-mail-send"></i>
      </button>

    </form>

    </div>
  </div>

@endsection
