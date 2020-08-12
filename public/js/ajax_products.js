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
     }
   });
  }
});

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
  // llamamos la funcion
  fave_unfave(url, product_id);
});
}

});
