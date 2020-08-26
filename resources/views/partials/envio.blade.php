<div id="envio" uk-modal>

  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación</h2>
    </div>

    <div class="uk-modal-body">
      <p>Editar el precio de envío</p>
    </div>

    <div class="uk-modal-footer uk-text-right">
      <form action="/editshipment" method="post">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        @csrf
        <input type="number" name="shipment_value" value="{{$shipment->value}}">
        <button class="uk-button uk-button-primary" type="submit">Actualizar</button>
      </form>
    </div>
  </div>
</div>
