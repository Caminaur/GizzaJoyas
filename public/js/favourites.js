window.addEventListener('load',function(){
  // Cantidad
  var quantity = document.querySelector('input[name="quantity"]');
  // Selector que nos provee el size_id
  quantity.addEventListener('change',function(){
    // deberia buscar el id de favourite
    var favourite_id = $(this).next('input').val();
    // Aca conseguimos el id de size
    var size_selector = $(this).siblings('select').val();
    console.log(size_selector);
    // Buscamos el input que guarda la cantidad del talle seleccionado
    var stock_quantity = document.querySelector('input[name="size_'+size_selector+'"]');
    // Si la cantidad seleccionada supera al stock
    var mensajeDeError = document.getElementById('errorMessage')
    var botonComprar = document.getElementById('agregar_carrito');

    // Lo buscamos de esta forma para que no genere problemas cuando haya varios favoritos agregados 
    var botonComprar = $(this).siblings('div').children('p');

    if (parseInt(quantity.value)>parseInt(stock_quantity.value)) {
      // mensaje de error
      mensajeDeError.removeAttribute('hidden');
      if (stock_quantity.value==0) {
        mensajeDeError.innerHTML = "Todos los productos disponibles en este talle ya se encuentran en tu carrito"
      }
      else {
        mensajeDeError.innerHTML = "Solamente hay " + stock_quantity.value + " productos disponibles en ese talle!"
      }
      // bloqueamos el boton de comprar
      botonComprar.setAttribute('type','button');
    }
    else if (quantity.value<=stock_quantity.value){
      mensajeDeError.setAttribute('hidden','true');
      mensajeDeError.innerHTML = "";
      botonComprar.setAttribute('type','submit');
    }
  })
})
