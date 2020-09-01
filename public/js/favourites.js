window.addEventListener('load',function(){
  $( document ).ready(function() {
    // Cantidad
    var quantities = document.querySelectorAll('input[name="quantity"]');
    for (var quantity of quantities) {
    // Selector que nos provee el size_id

    quantity.addEventListener('change',function(){
      var quantity_value = this.value;
      // deberia buscar el id de favourite
      var favourite_id = $(this).siblings('.favourite_id').val()
      // Aca conseguimos el id de size
      var product_id = $(this).siblings('.product_id').val();
      // Aca conseguimos el id de size
      var size_selector = $(this).siblings('select').val();
      // Buscamos el input que guarda la cantidad del talle seleccionado
      var stock_quantity = document.querySelector('input[name="size_'+product_id+'_'+size_selector+'"]');
      // Si la cantidad seleccionada supera al stock
      // var mensajeDeError = document.getElementById('errorMessage');
      var botonComprar = document.getElementById('agregar_carrito');
      var botonComprar = $(this).siblings('.boton_agregar');
      // Lo buscamos de esta forma para que no genere problemas cuando haya varios favoritos agregados
      var mensajeDeError = $(this).parents('div').siblings('div').children('p');
      // console.log("Quantity: " + quantity_value);
      // console.log("Favourite id: " + favourite_id);
      // console.log("Product id: " + product_id);
      // console.log("Size selector: " + size_selector);
      // console.log("Stock: " + stock_quantity);

      if (parseInt(quantity_value)>parseInt(stock_quantity.value)) {
        // mensaje de error
        mensajeDeError.removeAttr('hidden');
        if (stock_quantity.value==0) {
          mensajeDeError.html("Todos los productos disponibles en este talle ya se encuentran en tu carrito");
        }
        else {
          mensajeDeError.html("Solamente hay " + stock_quantity.value + " productos disponibles en ese talle!");
        }
        // bloqueamos el boton de comprar
        // botonComprar.preventDefault();
      }
      else if (quantity.value<=stock_quantity.value){
        mensajeDeError.attr('hidden','true');
        mensajeDeError.html('');
        // botonComprar.submit();
      }
    });
  }
  });
});
