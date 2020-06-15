@extends('layouts.plantilla')
@section('titulo')
Recuperar Clave
@endsection
@section('main')

  <div class="wrapper" style="background-color: rgb(226, 231, 235);">

		<div class="inner">
			<div class="image-holder align-self-center">
				<img src="/img/rings/diamante.jpg" alt="">
        <div class="text-center mt-3">
          <i class="social fab fa-instagram"></i>
          <i class="social fab fa-whatsapp"></i>
          <i class="social fab fa-facebook-f"></i>
        </div>
			</div>



			<form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

				<h2 class="blueSlate bold text-center mb-4">RESTABLECER CLAVE</h2>

				<div class="form-wrapper">
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="email" required autocomplete="email" autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @else
            <i class="zmdi zmdi-email"></i>
          @enderror
				</div>

				<div class="form-wrapper">
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nueva clave" required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @else
            <i class="zmdi zmdi-lock"></i>
          @enderror
				</div>

				<div class="form-wrapper">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar clave" required autocomplete="new-password">
          <i class="zmdi zmdi-lock-outline"></i>
				</div>

        <button type="submit" class="btn bg-blueSlate">Restablecer
          <i class="zmdi zmdi-mail-send"></i>
        </button>

      </form>

      </div>
  </div>


@endsection
