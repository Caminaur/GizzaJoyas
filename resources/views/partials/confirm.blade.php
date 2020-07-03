{{-- https://youtu.be/7QWZxjgvEQc?t=1204 --}}
{{-- Ejemplo de personalizar el mensaje del modal --}}
{{-- @include('partials.confirm',['url'=>'/deleteproduct/'.$product->id,'mensaje' => 'seguro?']) --}}
<div id="confirm" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Confirmacion</h2>
        <p>{{ $mensaje ?? "¿Desea eliminar el producto?"}}</p>
        <p class="uk-text-right">
            <a class="uk-button uk-button-default uk-modal-close" type="button">Cancel</a>
            <a class="uk-button uk-button-primary" href="{{$url}}" type="button">Eliminar</a>
        </p>
    </div>
</div>
