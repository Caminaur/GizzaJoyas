@extends('layouts.plantilla')
@section('titulo')
Activar cuenta
@endsection
@section('main')

  <div class="wrapper justify-content-center align-items-start" style="background-color: rgb(226, 231, 235);">

    <div class="card">
		   <div class="card-header">
         <h2 class="blueSlate bold text-center mb-4">ACTIVACIÓN DE SU CUENTA</h2>
       </div>

       <div class="card-body">

         <h5 class="blueSlate">Le hemos enviado un email, por favor verifique su correo y acceda al enlace para activar su cuenta.</h5>

         <h6 class="blueSlate">Para solicitar otro correo de activación<a class="ashBlue" href="{{ route('verification.resend') }}"> Haz click aquí</a></h6>

         @if (session('resent'))
           <div class="alert alert-success" role="alert">
             {{ __('Se ha enviado un link de activación a su correo.') }}
           </div>
         @endif

       </div>

    </div>

  </div>

@endsection
