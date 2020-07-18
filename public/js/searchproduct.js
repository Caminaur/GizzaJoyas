window.addEventListener('load',function(){

  categoryDiv = document.getElementById('categoryDiv');
  materialDiv = document.getElementById('materialDiv');
  brandDiv = document.getElementById('brandDiv');

  radioCategory = document.getElementById('radioCategory');
  radioMaterial = document.getElementById('radioMaterial');
  radioBrand = document.getElementById('radioBrand');

  radioCategory.addEventListener('click',function(){
    materialDiv.setAttribute('hidden','true');
    brandDiv.setAttribute('hidden','true');
    categoryDiv.removeAttribute('hidden');
  });
  radioMaterial.addEventListener('click',function(){
    categoryDiv.setAttribute('hidden','true');
    brandDiv.setAttribute('hidden','true');
    materialDiv.removeAttribute('hidden');
  })
  radioBrand.addEventListener('click',function(){
    categoryDiv.setAttribute('hidden','true');
    materialDiv.setAttribute('hidden','true');
    brandDiv.removeAttribute('hidden');
  })
})
