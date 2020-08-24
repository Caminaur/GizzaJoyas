// Desaparecer un alert
$(".alert").fadeTo(4000, 500).slideUp(500, function(){
	$(".alert").slideUp(500);
});


// Animated icons
var t = 0;

$(function () {
	$('.animated-icon').click(function (e) {
		$(this).toggleClass('anim');
	});

	play();
});

function play () {
	$('.animated-icon').click();
	t = setInterval(function () {
		$('.animated-icon').click();
	},2500);

	$('.left-side').on('mousemove',function () {
		clearInterval(t);

		$('.animated-icon').removeClass('anim');

		$(this).off('mousemove');
	});
}

// Toma el nombre del archivo que queremos subir y lo pone dentro del elemento con la clase info para que podamos verlo.
// esta funcion la utilizamos para cambiar la fachada del input file y poder seguir viendo los nombres de los archivos subidos.

function change(){

	var pdrs = document.getElementById('file-upload').files;

	// div donde se insertaran los names de las images
  var info = document.getElementById('info');

	// lo vaciamso para evitar que se repitan
	info.innerHTML = "";

	// recorremos los archivos subidos
  for (var i = 0; i < pdrs.length; i++) {

		// guardamos el nombre del archivo
    var image_name = pdrs[i].name;

		// creamos una etiqueta
		var etiqueta_p = document.createElement('p');

		// guardamos el nombre del archivo en ella
		etiqueta_p.innerHTML = image_name;

		// lo metemos en el div
		info.appendChild(etiqueta_p);
  }

}
