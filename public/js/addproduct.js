window.addEventListener('load',function(){

  const category = document.getElementById('category');

  category.addEventListener('change',function(){
    // TALLES
    // Corresponde al div donde se agregaran los talles
    var divCentral = document.getElementById('talles')
    // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
    divCentral.innerHTML = "";
    // traemos los inputs de ese talle en particular
    var inputsTalles = document.querySelectorAll('.categoria' + category.value)

    for (var talle of inputsTalles) {

      var divTalle = document.createElement('div')

      var sizeLabel = document.createElement('label');

      sizeLabel.innerHTML = talle.value;

      var size = document.createElement('input');

      size.name = talle.value;
      size.setAttribute('type','number');
      size.setAttribute('class','form-control-checkout px-1');
      size.setAttribute('value', 0);
      size.value = 0

      divTalle.setAttribute('class','centrado col-4 col-lg-2 form-group')

      divTalle.appendChild(sizeLabel)

      divTalle.appendChild(size)

      divCentral.appendChild(divTalle)

      // Mostramos la label "Ingrese el stock por talle:"
      var stock_title = document.getElementById('show_stock');
      stock_title.removeAttribute('hidden');
    }
    // En caso de que la categoria sea de talle unico agregamos igual mente el input de quantity
    if (inputsTalles.length===0) {
      var divTalle = document.createElement('div')
      divTalle.setAttribute('class','centrado col-4 col-lg-2 form-group')
      var size = document.createElement('input');
      size.value = 0
      var sizeLabel = document.createElement('label');
      sizeLabel.innerHTML = "Talle Unico";
      size.setAttribute('type','number');
      size.setAttribute('class','form-control-checkout px-1');
      divTalle.appendChild(sizeLabel)
      divTalle.appendChild(size)
      divCentral.appendChild(divTalle)
      // Mostramos la label "Ingrese el stock por talle:"
      var stock_title = document.getElementById('show_stock');
      stock_title.removeAttribute('hidden')
    }


  // TAGS
  // Corresponde al div donde se agregaran los tags
  var divCentral = document.getElementById('tags')
  // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
  divCentral.innerHTML = ""
  // Recopilamos los inputs de los tags correspondientes a esa categoria
  var inputTags = document.querySelectorAll('.tag' + category.value);
  // Recorremos cada uno y lo agregamos al div
  for (var tag of inputTags) {
    // Creamos el div individual que contendra un tag
    var divTag = document.createElement('div');
    // Le damos estetica
    divTag.setAttribute('class','col-md-3 centrado');

    // Preparamos las opciones

    // Creamos el label y el input de la opcion
    var tagLabel = document.createElement('label');
    tagLabel.innerHTML = tag.value;

    var tagInput = document.createElement('input');
    tagInput.name = tag.value;
    tagInput.value = tag.value;
    tagInput.type = 'checkbox';

    // Armamos el div del tag individual
    divTag.appendChild(tagLabel);
    divTag.appendChild(tagInput);
    // Lo agregamos al div central de tags
    divCentral.appendChild(divTag)
    // Mostramos la label "Lista de Tags:"
    var tags_title = document.getElementById('show_tags');
    tags_title.removeAttribute('hidden');
  }
  })

  // Creacion de input descuento en vista add product
  function onSale(){
    // Selecciono el select con id onSale y el div de discount que tiene la clase hidden
    var onSale = document.getElementById('onSale');
    var discount = document.getElementById('discount');
    var inputDiscount = document.getElementById('inputDiscount');

        // Creo un evento que actue cuando cambia el value del input onSale
        onSale.addEventListener('change',function(){
          if (onSale.value==1) {
            discount.removeAttribute("hidden",'false');
          } else {
            discount.setAttribute("hidden",'true');
            inputDiscount.value=null;
          }
    }) // cierre del evento change de onSale
  }// cierre de la funcion onSale
  onSale();
})
