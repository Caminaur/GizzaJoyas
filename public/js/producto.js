window.addEventListener('load',function(){
  // Traigo los botones de suma y de resta
  var botones = document.querySelectorAll('button[name="cantidad"]');
  var quantity = document.getElementById('quantity')
  // traigo el select de talle nos provee el id del talle seleccionado
  var size = document.getElementById('select_size');
  for (var boton of botones) {
    boton.addEventListener('click',function(){
      // Buscamos el input que guarda la cantidad del talle seleccionado
      var stock_quantity = document.querySelector('input[name="'+size.value+'"]');
      // Si la cantidad seleccionada supera al stock
      var mensajeDeError = document.getElementById('errorMessage')
      var botonComprar = document.getElementById('comprar_button');
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
      else if (parseInt(quantity.value)<=parseInt(stock_quantity.value)){
        mensajeDeError.setAttribute('hidden','true');
        mensajeDeError.innerHTML = "";
        botonComprar.setAttribute('type','submit');
      }
    })
  }
})
