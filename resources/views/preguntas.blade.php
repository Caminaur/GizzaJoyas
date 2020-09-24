@extends('layouts.plantilla')
@section('titulo')
Producto
@endsection
@section('main')

  <ul class="uk-breadcrumb px-4 py-2">
    <li><a href="">Inicio</a></li>
    <li><span class="dandelion">Preguntas Frecuentes</span></li>
  </ul>

  <div class="uk-background-muted p-4">


    <section>

      @foreach ($faqs as $faq)
        <a class="w-100 text-left hvr-icon-down uk-button uk-button-default" type="button" uk-toggle="target: #toggle-animation-multiple{{$faq->id}}; animation:  uk-animation-slide-left, uk-animation-slide-bottom">{{$faq->title}} <i class="hvr-icon fas fa-chevron-down"></i></a>
        <div id="toggle-animation-multiple{{$faq->id}}" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
          {{$faq->description}}
        </div>
        <br>

        {{-- Si hay una imagen --}}
          @if ($faq->image_path)
            <div id="toggle-animation-multiple{{$faq->id}}" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
            <button class="botontabladetalles" data-toggle="modal" data-target="#exampleModal{{$faq->id}}">
              <img class="imagenfaqs" src="/storage/{{$faq->image_path}}" alt="">
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$faq->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$faq->id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <img class="imagenfaqs" src="/storage/{{$faq->image_path}}" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
      @endforeach

    </section>

  </div>

@endsection
