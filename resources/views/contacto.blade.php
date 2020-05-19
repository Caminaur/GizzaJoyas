@extends('layouts.plantilla')
@section('titulo')
Contactanos
@endsection
@section('main')

  <div class="wrapper" style="background-color: rgb(226, 231, 235);">

			<div class="inner">
				<div class="image-holder align-self-center">
					<img src="/img/necklaces/contact.jpg" alt="">
          <div class="text-center mt-3">
            <a href="#"><i class="social fab fa-whatsapp" target="_blank"></i></a>
            <a href="#"><i class="social fas fa-phone-alt" target="_blank"></i></a>
            <a href="https://www.instagram.com/gizzajoyas" target="_blank"><i class="social fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/gizza.joyas" target="_blank"><i class="social fab fa-facebook-f"></i></a>
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


				</form>
			</div>
		</div>

@endsection
