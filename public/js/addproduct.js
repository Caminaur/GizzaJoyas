window.addEventListener('load',function(){

  const category = document.getElementById('category');

  category.addEventListener('change',function(){
    // TALLES
    // Corresponde al div donde se agregaran los talles
    var divCentral = document.getElementById('talles')
    // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
    divCentral.innerHTML = ""

    // traemos los inputs de ese talle en particular
    var inputsTalles = document.querySelectorAll('.categoria' + category.value)

    for (var talle of inputsTalles) {

      var divTalle = document.createElement('div')

      var sizeLabel = document.createElement('label');

      sizeLabel.innerHTML = talle.value;

      var size = document.createElement('input');

      size.name = talle.value;
      size.setAttribute('type','number');
      size.value = 0

      divTalle.setAttribute('class','col-md-4 offset-md-2 form-group')

      divTalle.appendChild(sizeLabel)

      divTalle.appendChild(size)

      divCentral.appendChild(divTalle)

    }
    // En caso de que la categoria sea de talle unico agregamos igual mente el input de quantity
    if (inputsTalles.length===0) {
      var divTalle = document.createElement('div')
      divTalle.setAttribute('class','col-md-4 offset-md-2 form-group')
      var size = document.createElement('input');
      size.value = 0
      var sizeLabel = document.createElement('label');
      sizeLabel.innerHTML = "Talle Unico";
      size.setAttribute('type','number');
      divTalle.appendChild(sizeLabel)
      divTalle.appendChild(size)
      divCentral.appendChild(divTalle)
    }


  // TAGS
  // Corresponde al div donde se agregaran los tags
  var divCentral = document.getElementById('tags')
  // Al cambiar de categoria se vacia el div, para luego llenarlo con los nuevos valores
  divCentral.innerHTML = ""
  // Recopilamos los inputs de los tags correspondientes a esa categoria
  var inputTags = document.querySelectorAll('.tag' + category.value)
  // Recorremos cada uno y lo agregamos al div
  for (var tag of inputTags) {
    // Creamos el div individual que contendra un tag
    var divTag = document.createElement('div');
    // Le damos estetica
    divTag.setAttribute('class','col-md-4 offset-md-2 form-group')
    // Creamos un titulo h5 para cada tag
    var h5tag = document.createElement('h5');
    // Le damos al titulo el nombre del tag
    h5tag.innerHTML = tag.value;

    // Preparamos las opciones

    // Creamos el label y el input de la opcion Si
    var tagLabelSi = document.createElement('label');
    tagLabelSi.innerHTML = 'SI'

    var tagInputSi = document.createElement('input');
    tagInputSi.name = tag.value
    tagInputSi.value = 'true'
    tagInputSi.type = 'radio'

    // Creamos el label y el input de la opcion No
    var tagLabelNo = document.createElement('label');
    tagLabelNo.innerHTML = 'NO'

    var tagInputNo = document.createElement('input');
    tagInputNo.name = tag.value
    tagInputNo.value = 'false'
    tagInputNo.type = 'radio'

    // Armamos el div del tag individual
    divTag.appendChild(h5tag)
    divTag.appendChild(tagLabelSi)
    divTag.appendChild(tagInputSi)
    divTag.appendChild(tagLabelNo)
    divTag.appendChild(tagInputNo)

    // Lo agregamos al div central de tags
    divCentral.appendChild(divTag)
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
