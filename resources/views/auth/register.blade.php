@extends('layouts.plantilla')
@section('links')
<!-- MATERIAL DESIGN ICONIC FONT -->
<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

<!-- STYLE CSS -->
<link rel="stylesheet" href="css/forms.css">
@endsection
@section('titulo')
Registro
@endsection
@section('main')

  <div class="wrapper" style="background-image: url('/img/extras/registerback.png');">

			<div class="inner">
				<div class="image-holder">
					<img src="/img/extras/registersmall.jpg" alt="">
				</div>

				<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          @csrf
					<h2 class="blueSlate bold text-center mb-4">FORMULARIO DE REGISTRO</h2>

					<div class="form-wrapper">
						<input id="name" value="{{ old('name') }}" type="text"  name="name" placeholder="Nombre de Usuario" class="form-control">
						<i class="zmdi zmdi-account"></i>
            @error('name')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>
					<div class="form-wrapper">
						<input id="email" value="{{ old('email') }}" type="email" name="email" placeholder="Email" class="form-control">
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
					<div class="form-wrapper">
						<input id="password-confirm" type="password" placeholder="Confirmar Clave" name="password_confirmation" class="form-control">
						<i class="zmdi zmdi-lock"></i>
            @error('password-confirm')
              <p class="errorForm">{{ $message }}</p>
            @enderror
					</div>

					<button type="submit" class="btn bg-blueSlate">Registrarse
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>

@endsection
