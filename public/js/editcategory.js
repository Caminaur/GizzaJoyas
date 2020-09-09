  window.addEventListener('load',function(){
    const divFormSize = document.getElementById('divFormSize');
    const AddSizeButton = document.getElementById('addSize');
    AddSizeButton.addEventListener('click',function(){
      // creamos la label
      var label = document.createElement('label');
      label.innerHTML = "Ingrese el talle";
      // creamos el input
      var input = document.createElement('input');
      input.name = 'sizes[]';
      input.setAttribute('required','true');
      input.setAttribute('class','form-control-checkout w-25');
      // creamos un div para organizarlos
      var div = document.createElement('div');
      // boton de borrado
      var button = document.createElement('button');
      button.setAttribute('type','button');
      button.setAttribute('class','close');
      button.setAttribute('aria-label','Close');
      // span
      var span = document.createElement('span');
      span.setAttribute('aria-hidden','true');
      span.setAttribute('class','botonEliminar');
      span.innerHTML = '&times;';

      // Div
      var div2 = document.createElement('div');
      div2.setAttribute('class','d-flex flex-row align-items-center');

      button.appendChild(span);

      div.setAttribute('class','d-flex flex-column align-items-center');
      div.appendChild(label);
      div2.appendChild(input);
      div2.appendChild(button);
      divFormSize.appendChild(div);
      divFormSize.appendChild(div2);
      // Agregar boton para eliminar el input de forma individual
      button.addEventListener('click',function(){
        this.parentNode.parentNode.removeChild(this.parentNode);
      })
    });
    var tagForm = document.getElementById("addTagId");
    var addTag = document.getElementById("addTag")
    addTag.addEventListener('click',function(){
      tagForm.removeAttribute('hidden');
    })
    var hide = document.getElementById('btnHide');
    hide.addEventListener('click',function(){
      tagForm.setAttribute('hidden','true');
    })
    var createTagBtn = document.getElementById('createTag');
    var divCreateTag = document.getElementById('createTagDiv');
    createTagBtn.addEventListener('click',function(){
      divCreateTag.removeAttribute('hidden');
    })
    var hideAddTag = document.getElementById('hideCreateTag');
    hideAddTag.addEventListener('click',function(){
      divCreateTag.setAttribute('hidden','true');
    })
  });
