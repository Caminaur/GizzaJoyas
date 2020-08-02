{{-- https://youtu.be/7QWZxjgvEQc?t=1204 --}}
{{-- Ejemplo de personalizar el mensaje del modal --}}
{{-- @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'mensaje' => 'seguro?']) --}}
<div id="confirmdeletecategory" uk-modal>

  <div class="uk-modal-dialog">

    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación</h2>
    </div>

    <div class="uk-modal-body">
      <p>{{ $message ?? ""}}</p>
    </div>
    <div class="uk-modal-footer uk-text-right">

      <form class="" action="{{$url}}" method="post">

        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        @csrf
        <input type="hidden" name="category_id" value="{{$category->id}}">
        <button class="uk-button uk-button-primary" type="submit">Borrar</button>

      </form>

    </div>

  </div>

</div>
