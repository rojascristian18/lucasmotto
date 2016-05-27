

function Admin_Imagenes_AgregarOtraImagen () {

	var NuevaImagenID = $("table#lista-imagenes").find("tr").size() - 1;

	var NuevaImagenHTML = "";

	NuevaImagenHTML += "<tr>";
	NuevaImagenHTML += "	<td>";
	NuevaImagenHTML += "		<input id='ImagenProducto" + NuevaImagenID + "Nombre' class='' type='file' required='required' data-field='portada' data-model='ImagenProducto' name='data[ImagenProducto][" + NuevaImagenID + "][nombre]'>";
	NuevaImagenHTML += "	</td>";
	NuevaImagenHTML += "	<td>";
	NuevaImagenHTML += "		Portada: ";
	NuevaImagenHTML += "		<input id='ImagenProducto" + NuevaImagenID + "Portada_' type='hidden' value='0' name='data[ImagenProducto][" + NuevaImagenID + "][portada]'>";
	NuevaImagenHTML += "		<input id='ImagenProducto" + NuevaImagenID + "Portada' class='icheckbox' type='checkbox' value='1' style='position: absolute; margin-left: 5px;' title='Marque para asignar la imagen como portada del producto' name='data[ImagenProducto][" + NuevaImagenID + "][portada]'>";
	NuevaImagenHTML += "	</td>";
	NuevaImagenHTML += "	<td><a class='btn btn-danger' onclick='eliminarImagenAgregada(this)'>Eliminar</a></td>";
	NuevaImagenHTML += "</tr>";

	$("table#lista-imagenes").append(NuevaImagenHTML);

}

function eliminarImagenAgregada( objeto ){

	$( objeto ).parent( 'td' ).parent( 'tr' ).remove();

}


function quitarImagenPrincipal( objeto , id ){
	var r = confirm( "¿Desea eliminar esta imágen?" );
	if ( r == true ) {

		$( objeto ).parent( '.image-exist' ).css( 'display', 'none' );
		$( objeto ).html( '<input type="hidden" name="ImagenProductoPrincipal" value="' + id + '"/>' );

	}else{

		return;

	}

}

function quitarImagenes( objeto , id ){

		var r = confirm( "¿Desea eliminar esta imágen?" );
		if ( r == true ) {

		    $( objeto ).parent().remove();

	       var ImgsEliminadas = $("input#imageneseliminadas").val();

	       if (ImgsEliminadas != "") ImgsEliminadas += "," ;

	       ImgsEliminadas += id;

	       $("input#imageneseliminadas").val(ImgsEliminadas);
	       
		} else {

		    return;

		}
		
}

$( document ).ready( function(){

	/**
	*	cargar productos al iniciar el sitio.
	*/
	var idCat = $( '#seccion-categoria .content .nav-tabs .active' ).data( 'cat' );
	
	getProducto(idCat);

	$( '.check-comparar' ).removeAttr('checked');


	/****************************************************
		Zoom para imágenes
	****************************************************/
	$( document ).on('mousemove' , '.zoomImage',function(event){

		var imagen = $( this );

		var left = imagen.offset().left;
		var top = imagen.offset().top;
		
		var x = event.pageX - left;
	    var y = event.pageY - top;

	    var centerTop =  (y - Math.floor(imagen.height() / 2));
	    var centerLeft = (x - Math.floor(imagen.width() / 2));

	    var rutaImagen = imagen.attr('src');

	    $( '.zoom' ).html('<img src="' + rutaImagen + '" class="responsive-img" id="imagenEscalada" >');
	    
	    $( '#imagenEscalada' ).css({
	    	'left' : -(centerLeft) + '% ',
	    	'top' : -(centerTop) +'%',
	    });
	});

	$( document ).on('mouseout', '.zoomImage' , function(){
		$( '.zoom' ).css({'width' : '0' , 'opacity' : '0'});

	});

	$( document ).on('mouseenter', '.zoomImage' , function(){
		$( '.zoom' ).css({'width' : '100%' , 'opacity' : '1'});
	});



	/****************************************************
		Validar campos del formulario de contacto
	****************************************************/

	$( '#submit' ).click(function(event){

		var Nombre 		= document.getElementById('PaginaNombre').value;
		var Apellido 	= document.getElementById('PaginaApellido').value;   
		var Email 		= document.getElementById('PaginaEmail').value;   
		var Fono 		= document.getElementById('PaginaFono').value;   
		var Mensaje 	= document.getElementById('PaginaMensaje').value;

		if (Nombre == "") {
			configModal('Error', 'Nombre vacio', 'error', 'Aceptar');
			event.preventDefault();
			return;
		}else{ 
			if(!Validations_IsValidText(Nombre)) {
				configModal('Alerta', 'Ingrese solo texto', 'alerta', 'Aceptar');
				event.preventDefault();
				return;
			};
		}

		if (Email == "") {
			console.log('email vacio');
			configModal('Error', 'Email vacio', 'error', 'Aceptar');
			event.preventDefault();
			return;
		}else{
			if(!Validations_IsValidEmail(Email)) {
				console.log('email invalido');
				configModal('Alerta', 'Ingrese un email válido', 'alerta', 'Aceptar');
				event.preventDefault();
				return;
			};
		};

		if (!Validations_IsValidNumber(Fono)) {
			configModal('Alerta', 'Ingrese solo números', 'alerta', 'Aceptar');
			event.preventDefault();
			return;
		};

		if (Mensaje == "") {
			configModal('Error', 'Complete el mensaje', 'error', 'Aceptar');
			event.preventDefault();
			return;
		};

		//Si todo esta bien se envia el formulario.

	});


	/****************************************************
		Consultar rut de cliente
	****************************************************/
	$( '#TransaccionSolicitudForm button' ).on('click', function( event ){

		event.preventDefault();

		nombreCliente = document.getElementById('ClienteNombre').value;
		rutCliente = document.getElementById('ClienteRut').value;
		emailCliente = document.getElementById('ClienteEmail').value;
		fonoCliente = document.getElementById('ClienteFono').value;

		if (nombreCliente == "") {
			configModal('Error', 'Nombre vacio', 'error', 'Aceptar');
			return;
		}else{ 
			if(!Validations_IsValidText(nombreCliente)) {
				configModal('Alerta', 'Ingrese solo texto', 'alerta', 'Aceptar');
				return;
			};
		}
		
		if (rutCliente == "") {
			configModal('Error', 'Rut vacio', 'error', 'Aceptar');
			return;
		}else{
			if(!Validations_IsValidRUT(rutCliente)) {
				configModal('Alerta', 'Ingrese un rut válido', 'alerta', 'Aceptar');
				return;
			};
		};

		if (emailCliente == "") {
			configModal('Error', 'Email vacio', 'error', 'Aceptar');
			return;
		}else{
			if(!Validations_IsValidEmail(emailCliente)) {
				configModal('Alerta', 'Ingrese un email válido', 'alerta', 'Aceptar');
				return;
			};
		};

		if (!Validations_IsValidNumber(fonoCliente)) {
			configModal('Alerta', 'Ingrese solo números', 'alerta', 'Aceptar');
			return;
		};

		$( '#TransaccionSolicitudForm' ).submit();

	});
	
	
	/****************************************************
		Habilitar y deshabilitar botón comparar.
	****************************************************/	 
	$( document ).on( "click", ".check-comparar" , function(){

		var inputCheckeados = $( ".check-comparar:checked" ).length;

			if( inputCheckeados == 0 ){
			  	$( '.toast' ).css('bottom', '-100%');
			  	return;
		  	}

			if( inputCheckeados > 3 ){
				$( '.toast' ).css('bottom', '0');
				$( this ).removeAttr('checked');
				$( '#comparador .form-container' ).css('left','-100%');
				$( '#ProductosCompararForm .btn-compare' ).attr('disabled','disabled');
				return;
			}

			if( inputCheckeados < 2 ){
				$( '.toast' ).css('bottom', '0');
				$( '#comparador .form-container' ).css('left','-100%');
				$( '#ProductosCompararForm .btn-compare' ).attr('disabled','disabled');
				return;
			}

			if( inputCheckeados > 1 ){
				$( '.toast' ).css('bottom', '-100%');
				$( '#comparador .form-container' ).css('left','0');
				$( '#ProductosCompararForm .btn-compare' ).removeAttr('disabled');
				return;
			}

	});

});


function getProducto( idCategria ){

	var url = webroot + "productos/getProductByCategoryId/" + idCategria;

	 $.get( url , function( response ){
		
		$( '.panel-productos' ).html( response );
	
	 });

}	

// Carrusel de productos

function moveLeft() {

	//deshabilita el botón para que no hagan click varias veces
	$("i#btn-toLeft").attr("disabled", "disabled");
	$("i#btn-toLeft").css("pointer-events", "none");

	//ancho de un elemento (para usar el que esté definido en el css)
	var ancho = $("div.brand-container ul li").eq(0).css("width");

	ancho = parseInt(ancho);

	//mueve el primer elemento de la lista colocando margen negativo
	$("div.brand-container ul li").eq(0).animate({"margin-left": "-=" + ancho + "px"}, "slow", function () {
		
		//se hace una copia del elemento que se movió y quedó oculto a la izquierda y se coloca al final de la lista

		var ListaModelos = $(this).parent();

		var ModeloHTML = "";

		ModeloHTML += "<li class='gallery-brand'>";
		ModeloHTML += $(this).html();
		ModeloHTML += "</li>";

		//se elimina el elemento que quedó oculto
		$(ListaModelos).find("li").eq(0).remove();

		$(ListaModelos).html($(ListaModelos).html() + ModeloHTML);

		//se coloca en cero el margen del elemento que se había copiado con el margen negativo
		$(ListaModelos).find("li").eq($(ListaModelos).find("li").size() - 1).css("margin-left", "0px");

		//activa el botón nuevamente
		$("i#btn-toLeft").removeAttr("disabled");
		var cssObject = $("i#btn-toLeft").prop("style");
		cssObject.removeProperty("pointer-events");
		
	});

}

function moveRight() {

	$("i#btn-toRight").attr("disabled", "disabled");
	$("i#btn-toRight").css("pointer-events", "none");

	var ancho = $("div.brand-container ul li").eq(0).css("width");

	ancho = parseInt(ancho);

	var ListaModelos = $("div.brand-container ul");

	var UltimoModelo = $(ListaModelos).find("li").eq($(ListaModelos).find("li").size() - 1);

	var ModeloHTML = "";

	ModeloHTML += "<li class='gallery-brand'>";
	ModeloHTML += $(UltimoModelo).html();
	ModeloHTML += "</li>";

	$(UltimoModelo).remove();

	$(ListaModelos).html(ModeloHTML + $(ListaModelos).html());

	$(ListaModelos).find("li").eq(0).css("margin-left", "-" + ancho + "px");
	
	$(ListaModelos).find("li").eq(0).animate({"margin-left": "0px"}, "slow", function () {

		$("i#btn-toRight").removeAttr("disabled");
		var cssObject = $("i#btn-toRight").prop("style");
		cssObject.removeProperty("pointer-events");
		
	});

}

Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
	    j = (j = i.length) > 3 ? j % 3 : 0;
   		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

function agregarComparar( obj ){

	if ( $( obj ).prop( 'checked' ) ) {

		var inputCheckeados = $( ".check-comparar:checked" ).length;

		if (inputCheckeados < 4) {

			

				var htmlInput = "<input type='checkbox' class='checkbox-comparar' name='comparar[]' id='comparar_input" + $( obj ).val() + "' value='" + $( obj ).val() + "' checked>";
		
				$( '#ProductosCompararForm div' ).append(htmlInput);

			
		};

	}else{		

		$( '#comparar_input' + $( obj ).val() ).remove();

	}
}

function showImage( image ){

	rutaImg = $( image ).attr( 'data-image' );

	$( '.imagen-principal' ).html( '<img src="' + fullwebroot + 'img/' + rutaImg + '" class="zoomImage">' );

	$( '.zoomImage' ).css('display','none');

	$( '.zoomImage' ).fadeIn(500);

}


function configModal( titulo, cuerpo , custom_class , boton, identificador = null){

	$('#modal .modal-content').removeClass('error');
	$('#modal .modal-content').removeClass('alerta');
	$('#modal .modal-content').removeClass('completado');
	$('#modal .modal-footer button').removeAttr('disabled');

	$('#modal .modal-title').text(titulo);
	$('#modal .modal-body').text(cuerpo);
	$('#modal .modal-footer button').text(boton);

	if (identificador == 1) {
		$('#modal .modal-footer button').attr('onclick','preAprobado();');;
	};


	$('#modal .modal-content').addClass(custom_class);

	$('#modal').modal('show');
}

function preAprobado(){
	window.location = "prearpobado";
}
