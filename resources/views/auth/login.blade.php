@extends('layouts.plantilla')
@section('links')
<!-- MATERIAL DESIGN ICONIC FONT -->
<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

<!-- STYLE CSS -->
<link rel="stylesheet" href="css/forms.css">
@endsection
@section('titulo')
Inicio de Sesion
@endsection
@section('main')

  <div class="wrapper" style="background-image: url('/img/extras/loginback.png');">

			<div class="inner">
				<div class="image-holder align-self-center">
					<img src="/img/extras/loginsmall.jpg" alt="">
				</div>

				<form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
          @csrf
					<h2 class="blueSlate bold text-center mb-4">INICIAR SESION</h2>

					<div class="form-wrapper">
						<input id="email" value="{{ old('email') }}" type="email" placeholder="Email" name="email" class="form-control">
						<i class="zmdi zmdi-email"></i>
            @error('email')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>
					<div class="form-wrapper">
						<input id="password" type="password" placeholder="Clave" name="password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
            @error('password')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>

          <div class="field-group remember-me">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="recordarme align-middle" for="remember-me"><small class="ashBlue">Recordarme</small></label>
          </div>


					<button class="btn bg-blueSlate">Ingresar
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>

@endsection
