{{-- https://youtu.be/7QWZxjgvEQc?t=1204 video importante que explica--}}
{{-- Ejemplo de personalizar el mensaje del modal en la vista--}}
{{-- @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'mensaje' => 'seguro?']) --}}

{{-- Si no le pasamos name o id se envian como parametros vacios --}}
@php
  if (!isset($name)){
    $name = '';
  }
  if (!isset($id)){
    $id = '';
  }
@endphp

<div id="confirm" uk-modal>

  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación</h2>
    </div>

    <div class="uk-modal-body">
      <p>{{ $message ?? "Esta seguro que lo desea eliminar?"}}</p>
    </div>

    <div class="uk-modal-footer uk-text-right">
      <form class="" action="{{$url}}" method="post">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        @csrf
        <input type="hidden" name="{{$name}}" value="{{$id}}">
        <button class="uk-button uk-button-primary" type="submit">Borrar</button>
      </form>
    </div>
  </div>
</div>
