@extends('layouts.plantilla')
@section('titulo')
Recuperar Clave
@endsection
@section('main')

  <div class="wrapper" style="background-color: rgb(226, 231, 235);">

			<div class="inner">
				<div class="image-holder align-self-center">
					<img src="/img/necklaces/contact.jpg" alt="">
          <div class="text-center mt-3">
            <i class="social fab fa-instagram"></i>
            <i class="social fab fa-whatsapp"></i>
            <i class="social fab fa-facebook-f"></i>
          </div>
				</div>



				<form method="POST" action="{{ url('contacto') }}" enctype="multipart/form-data">
          @csrf
					<h2 class="blueSlate bold text-center mb-4">Contactanos</h2>

					<div class="form-wrapper">
						<input id="name" value="{{ old('name') }}" type="text"  name="name" placeholder="Nombre completo" class="form-control" required>
						<i class="zmdi zmdi-account"></i>
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>
					<div class="form-wrapper">
						<input id="email" value="{{ old('email') }}" type="email" name="email" placeholder="Email" class="form-control" required>
						<i class="zmdi zmdi-email"></i>
            @error('email')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>
					<div class="form-wrapper">
						<input id="message" type="text" placeholder="Dejanos tu mensaje" name="message" class="form-control" required>
            <i class="zmdi zmdi-comments"></i>
            @error('message')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>

					  <button type="submit" class="btn bg-blueSlate">Enviar
						  <i class="zmdi zmdi-mail-send"></i>
					  </button>

            <br>



				</form>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
			</div>
		</div>


@endsection
