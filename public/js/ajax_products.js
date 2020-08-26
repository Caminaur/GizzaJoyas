window.addEventListener('load',function(){
$(document).ready(function(){
  $('#search').keyup(function(e){
    document.getElementById('prueba_ajax').innerHTML = "";
    fetch_customer_data(this.value);
  });
  function fetch_customer_data(query = ''){
    $.ajax({
     url:'/live_search/action',
     method:'GET',
     data:{query:query},
     dataType:'json',
     success:function(data)
     {
      // Traemos los productos buscados
      $('#prueba_ajax').html(data.table_data);
      // Agregamos la funcionalidad de faves a la busqueda realizada
      faves();

      // orgenamos el paginador

      // borramos el paginador anterior
      $('#paginas').html(data.paginas);
      // por cada nuevo boton del paginador
      $('.pages-item').click(function(e){
        // frenamos el evento
        e.preventDefault();
        // preparamos el ajax
        href = jQuery(this).children('a').attr('href');
        query = $('#search').val();
        $.ajax({
          url:href,
          method:'GET',
          data:{query:query},
          dataType:'json',
          // en caso de success
          success:function(data)
          {
            console.log(data.paginas_cantidad);
            // borramos la clase al objeto anterior y su id
            if (document.getElementById('active_page') != null) {
              document.getElementById('active_page').setAttribute('class','pages-item');
              document.getElementById('active_page').removeAttribute('id');
            }
            // buscamos el id de la pagina actual y lo trasformamos en un int
            var paginador_id =  parseInt(data.pagina_actual);
            // buscamos los li del paginador
            var paginador_test =  $('#paginas').children('ul').children('li');
            // El for loop va a comparar el paginador_id con el length del array
            for (var i = 0; i < paginador_test.length; i++) {
              if (i===1) {
                paginador_test[i].setAttribute('class','pages-item');
              }
              if (paginador_id === i) {
                // en caso de que se cumpla la condicion
                // agregamos estetica de bootstrap al li particular
                paginador_test[i].setAttribute('class',"pages-item active");
                // y le agregamos un id para buscarlo
                paginador_test[i].setAttribute('id',"active_page");
              }
            }
            // Siguente pagina

            // ponemos un id al selector >
            next = document.getElementById('last_page');
            if (paginador_test.length===paginador_id+2) {
              next.setAttribute('href','#');
            }
            else {
              href = '/product/page/' + (paginador_id+1);
              next.setAttribute('href',href);
            }
            next.setAttribute('href',href);

            // Pagina previa
            previous = document.getElementById('previous_page');
            if (paginador_id===1) {
              href_previous = "#";
            }
            else {
              href_previous = '/product/page/' + (paginador_id-1);
            }
            previous.setAttribute('href',href_previous);

            // Traemos los productos buscados
            $('#prueba_ajax').html(data.table_data);
            // Agregamos la funcionalidad de faves a la busqueda realizada
            faves();
          } // success

        }); // Ajax

      }); // .paginas-item click

   } // success
   }); // ajax
 } // fetch_customer_data
}); // ready

// Peticion ajax de favoritos
function fave_unfave(url = '', product_id = ''){
  // se inicia la peticion ajax, en 'data' podemos pasar los datos que queremos procesar en el back
  $.ajax({
   url:url,
   method:'GET',
   data:{product_id:product_id},
   dataType:'json',
   success:function(data)
   {
     // Query de busqueda, es solamente para que sea mas entendible el codigo
     var query = '#product' + data.product_id;
     // Usamos la query para traer el div del heart icon
     var div_icon = $(query).siblings('a').children('div').children('span');
     // Editamos la clase dependiendo de la respuesta del servidor
     if (data.isFave == true) {
       // Le agregamos la clase correspondiente
       div_icon.attr('class',data.selected_class);
       UIkit.notification({message: 'Producto agregado a favoritos correctamente', pos: 'bottom-right', status:'primary',timeout:1300});
     }
     else {
       // le agregamos la clase correspondiente
       div_icon.attr('class',data.selected_class);
       UIkit.notification({message: 'Producto eliminado de favoritos correctamente', pos: 'bottom-right',status:'danger',timeout:1300});
     }
     // hacemos un update de la cantidad de favos
     $('#items-in-favs').html(data.cantidad_favs);

   } // success
 }); // ajax
} // function unfave

// funcion de favoritos
function faves(){
$('.favourite_icon_ajax').click(function(e){
  e.preventDefault();
  // al precionar en el boton agregar a favoritos buscamos el padre con la etiqueta a
  var url = $(this).attr('href');
  // traemos el id del producto
  var product_id = $(this).siblings('input').val();
  console.log();
  if ($('#control_de_registro').val()==="false") {
    UIkit.notification({message: 'Debes estar registrado para poder agregar un producto a favoritos', pos: 'bottom-right', status:'primary',timeout:1300});
  }
  else {
    // llamamos la funcion
    fave_unfave(url, product_id);
  }
});
}




});
