window.addEventListener('load',function(){
$(document).ready(function(){
  $('.etiqueta_borrar').click(function(e){
    e.preventDefault();
    // href
    var src = $(this).attr('href');
    var fave_id = $(this).siblings('input').val();
    // div del producto
    var product_div = $(this).parents('.producto.row');
    $.ajax({
     url:src,
     method:'GET',
     data:{fave_id:fave_id},
     dataType:'json',
     success:function(data)
     {
       // hacemos un update de la cantidad de favos
       $('#items-in-favs').html(data.total);
      // En caso de success devolvemos la alerta de exito
      UIkit.notification({message: data.message, pos: 'bottom-right', status:'danger',timeout:1700});
      // y borramos el div de ese favorito
      product_div.fadeOut();
     }
   });

  }); // etiqueta borrar
}); // ready
}); // window on load
