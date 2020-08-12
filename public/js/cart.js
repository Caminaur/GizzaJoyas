window.addEventListener('load',function(){

  // Buscamos los botones de suma y de resta
  var botones = document.querySelectorAll('button[name="cantidad"]');
  // Organizamos las funciones de los botones de suma y resta
  for (var boton of botones) {
    boton.addEventListener('click',function(){

      // Esta seccion maneja los precios

      // buscamos donde se encuentra el precio total del producto en particular
      var precioProducto = this.parentNode.parentNode.querySelector('span[name=price]');
      var precioProductoHidden = this.parentNode.parentNode.querySelector('input[name=priceHidden]');

      // buscamos el valor del precio individual
      var valorIndividual = this.parentNode.querySelector('input[name="precios"]').value; // ej 3600

      // Busamos la cantidad pedida de este producto
      var productoCantidad = this.parentNode.querySelector("input[name=quantity]").value;

      // Modificamos el span de acuerdo a los cambios realizados
      precioProducto.innerHTML = '$' + formatNumber( (valorIndividual * productoCantidad) , 0 , '.' , ',' );

      precioProductoHidden.value = valorIndividual * productoCantidad;

      // Modificamos el subtotal
      var subtotal = document.getElementById('subtotal')

      // buscamos los precios de cada producto agregado al carrito
      var preciosProductos = document.querySelectorAll('input[name=priceHidden]');

      // Cada uno lo sumamos a la variable precio final
      var precioFinal = 0;
      for (var precio of preciosProductos) {
        var precioFinal = parseInt(precioFinal) + parseInt(precio.value);
      }

      // Modificamos el subtotal para que refleje los cambios realizados
      subtotal.innerHTML = 'Subtotal: $' + formatNumber( precioFinal , 0 , '.' , ',' );



      // Esta seccion realiza un control de stock

      var quantity = this.parentNode.querySelector('input[name="quantity"]')
      // traigo el select de talle nos provee el id del talle seleccionado
      var size = document.getElementById('size');
      // Buscamos el input que guarda la cantidad del talle seleccionado
      var stock_quantity =this.parentNode.querySelector('input[name="cantidad_max"]')
      // Si la cantidad seleccionada supera al stock
      var mensajeDeError = this.parentNode.parentNode.querySelector('span[name="errorMessage"]')
      var botonComprar = document.getElementById('boton_comprar');

      // El parseInt nos permite asegurar que los datos comparados sean numero enteros
      if (parseInt(quantity.value)>parseInt(stock_quantity.value)) {
        // mensaje de error
        mensajeDeError.removeAttribute('hidden');
        mensajeDeError.innerHTML = "Solamente hay " + stock_quantity.value + " productos disponibles en ese talle!"
        // bloqueamos el boton de comprar
        botonComprar.setAttribute('type','button');
      }
      else if (quantity.value<=stock_quantity.value){
        mensajeDeError.setAttribute('hidden','true');
        mensajeDeError.innerHTML = "";
        botonComprar.setAttribute('type','submit');


        // Organizamos lo que vamos a enviar al backend
        // Este nos va a proveer el id del cart al que se le sumo la cantidad
        var cart_id = this.parentNode.querySelector('input[name="cart_id"]').value;
        // Con este id armamos un string de busqueda
        var string = 'cart'+ cart_id;
        // buscamos el input en donde vamos a enviar la cantidad pedida
        var inputEnvioCantidad = document.getElementById(string);
        // modificamos el valor con la quantity actual
        inputEnvioCantidad.value = quantity.value;
      }


    })
  }



  // Funcion para darle formato a los precios dinamicos
  // Link: https://stackoverflow.com/questions/19307271/how-to-format-clean-numbers-so-1000-appear-as-1-000-00
  function formatNumber(n, p, ts, dp) {
    var t = [];
    // Get arguments, set defaults
    if (typeof p  == 'undefined') p  = 2;
    if (typeof ts == 'undefined') ts = ',';
    if (typeof dp == 'undefined') dp = '.';

    // Get number and decimal part of n
    n = Number(n).toFixed(p).split('.');

    // Add thousands separator and decimal point (if requied):
    for (var iLen = n[0].length, i = iLen? iLen % 3 || 3 : 0, j = 0; i <= iLen; i+=3) {
      t.push(n[0].substring(j, i));
      j = i;
    }
    // Insert separators and return result
    return t.join(ts) + (n[1]? dp + n[1] : '');
  }

  console.log(formatNumber(
    5220.567,  // value to format
                 0,  // number of decimal places
                '.', // thousands separator
                ','  // decimal separator
  ));

})
