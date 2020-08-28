<div id="envio" uk-modal>

  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Confirmación</h2>
    </div>

    <div class="uk-modal-body">
      <p>Editar el precio del envío</p>
    </div>

    <div class="uk-modal-footer uk-text-right">
      <form class="align-items-center d-flex justify-content-between" action="/editshipment" method="post">
        @csrf
        <input class="form-control-checkout w-25" type="number" name="shipment_value" step="100" value="{{$shipment->value}}">
      <div class="">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        <button class="uk-button uk-button-primary" type="submit">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>
