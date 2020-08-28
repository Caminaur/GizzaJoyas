window.addEventListener('load',function(){
$(document).ready(function(){
  $('#add_to_favourite').click(function(e){
    e.preventDefault();
    // href
    var src = $(this).attr('href');
    var product_id = $(this).siblings('input').val();

    $.ajax({
     url:src,
     method:'GET',
     data:{product_id:product_id},
     dataType:'json',
     success:function(data)
     {
       // hacemos un update de la cantidad de favos
       $('#items-in-favs').html(data.cantidad_favs);
       $('#heart_icon').attr('class',data.selected_class);
      // En caso de success devolvemos la alerta de exito
      if (data.isFave) {
        UIkit.notification({message: data.message, pos: 'bottom-right', status:'primary',timeout:1700});
      }
      else {
        UIkit.notification({message: data.message, pos: 'bottom-right', status:'danger',timeout:1700});
      }
     }
   });

  }); // etiqueta borrar
}); // ready
}); // window on load
