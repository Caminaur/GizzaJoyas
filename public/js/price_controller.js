window.addEventListener('load',function(){
  const criterio_busqueda = document.getElementById('criterio_busqueda');
  var categoryDiv = document.getElementById('categoryDiv');
  var materialDiv = document.getElementById('materialDiv');
  var brandDiv = document.getElementById('brandDiv');
  var prices_button = document.getElementById('prices_button');
  var error_button_div = document.getElementById('error_button_div');

  criterio_busqueda.addEventListener('change', function(){
    error_button_div.setAttribute('hidden',true);
    if (criterio_busqueda.value === 'category') {
      materialDiv.setAttribute('hidden','true');
      brandDiv.setAttribute('hidden','true');
      categoryDiv.removeAttribute('hidden');
    }
    else if (criterio_busqueda.value === 'material') {
      categoryDiv.setAttribute('hidden','true');
      brandDiv.setAttribute('hidden','true');
      materialDiv.removeAttribute('hidden');
    }
    else if (criterio_busqueda.value === 'brand') {
      categoryDiv.setAttribute('hidden','true');
      materialDiv.setAttribute('hidden','true');
      brandDiv.removeAttribute('hidden');
    }
    else {
      categoryDiv.setAttribute('hidden','true');
      materialDiv.setAttribute('hidden','true');
      brandDiv.setAttribute('hidden','true');
    }
  });

  prices_button.addEventListener('click',function(e){
    error_button_div.innerHTML = "";
    if (!criterio_busqueda.value) {
      e.preventDefault();
      var mensaje = document.createElement('p');
      mensaje.innerHTML = "Por favor seleccione un criterio de busqueda!";
      mensaje.style.color = "red";
      error_button_div.style.justifyContent = "center";
      error_button_div.appendChild(mensaje);
    }
  });

})

// if (!criterio_busqueda.value) {
//     para bloquear el boton
// }
