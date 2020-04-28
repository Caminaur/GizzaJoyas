@extends('layouts.plantilla')
@section('titulo')
Activar cuenta
@endsection
@section('main')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su dirección de correo para activar la cuenta') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un link de activación a su correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifique su correo y acceda al link de activación') }}
                    {{ __('Si no recibes ningún email') }}, <a href="{{ route('verification.resend') }}">{{ __('haz click aquí para solicitar otro') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
