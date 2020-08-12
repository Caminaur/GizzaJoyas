window.addEventListener('load',function(){
$(document).ready(function(){
  $('.favourite_icon_ajax').click(function(e){
    e.preventDefault();
    // al precionar en el boton agregar a favoritos buscamos el padre con la etiqueta a
    var url = $(this).attr('href');
    // traemos el id del producto
    var product_id = $(this).siblings('input').val();
    // llamamos la funcion
    fave_unfave(url, product_id);
  });
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
}); // document on ready
}); // add event listener on load
