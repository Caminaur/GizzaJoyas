<div id="importarexcel" uk-modal>

  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
        <h2 class="uk-modal-title">Actualizacion de productos</h2>
    </div>

    <div class="uk-modal-body">
      <p style="font-size:20px;">Importar excel con los productos modificados</p>
      <p style="font-size:20px; color:red;">Solamente se puede editar el descuento, precio y nombre de cada producto</p>
    </div>

    <div class="uk-modal-footer uk-text-right">
      <form class="align-items-center d-flex justify-content-between" action="/importexcel" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file-upload" class="subir">
        <i class="fas fa-cloud-upload-alt"></i> Subir excel
        </label>
        <input type="file" id="file-upload" onchange='change()' style='display: none;' class="sin-archivo"  name="excel" value="" required>
      <div class="">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
        <button class="uk-button uk-button-primary" type="submit">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>
