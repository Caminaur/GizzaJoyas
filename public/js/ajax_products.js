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
      $('#prueba_ajax').html(data.table_data);
     }
   });
  }
});
});
