window.addEventListener('load',function(){
  // Cantidad
  var quantity = document.querySelector('input[name="quantity"]');
  // Selector que nos provee el size_id
  var size_selector = document.getElementById('size');
  quantity.addEventListener('change',function(){
    // Buscamos el input que guarda la cantidad del talle seleccionado
    var stock_quantity = document.querySelector('input[name="'+size_selector.value+'"]');
    // Si la cantidad seleccionada supera al stock
    var mensajeDeError = document.getElementById('errorMessage')
    var botonComprar = document.getElementById('agregar_carrito');
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
