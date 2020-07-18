const AddSizeButton = document.getElementById('addSize');
AddSizeButton.addEventListener('click',function(){
  // creamos la label
  var label = document.createElement('label');
  label.innerHTML = "Ingrese el talle";
  // creamos el input
  var input = document.createElement('input');
  input.name = 'sizes[]';
  input.setAttribute('required','true');
  input.setAttribute('class','ml-3');
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

  button.appendChild(span);

  div.setAttribute('class','row m-2 p-2');
  div.appendChild(label);
  div.appendChild(input);
  div.appendChild(button);
  divFormSize.appendChild(div);
  // Agregar boton para eliminar el input de forma individual
  button.addEventListener('click',function(){
    this.parentNode.parentNode.removeChild(this.parentNode);
  })
});
