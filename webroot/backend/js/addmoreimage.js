function Admin_Imagenes_AgregarOtraImagen () {

	var NuevaImagenID = $("table#lista-imagenes").find("tr").size() - 1;

	var NuevaImagenHTML = "";

	NuevaImagenHTML += "<tr>";
	NuevaImagenHTML += "	<td>";
	NuevaImagenHTML += "		<input id='ProductoImagen" + NuevaImagenID + "Nombre' class='' type='file' required='required' data-field='portada' data-model='ProductoImagen' name='data[ProductoImagen][" + NuevaImagenID + "][nombre]'>";
	NuevaImagenHTML += "	</td>";
	NuevaImagenHTML += "	<td>";
	NuevaImagenHTML += "		Portada: ";
	NuevaImagenHTML += "		<input id='ProductoImagen" + NuevaImagenID + "Portada_' type='hidden' value='0' name='data[ProductoImagen][" + NuevaImagenID + "][portada]'>";
	NuevaImagenHTML += "		<input id='ProductoImagen" + NuevaImagenID + "Portada' class='icheckbox' type='checkbox' value='1' style='position: absolute; margin-left: 5px;' title='Marque para asignar la imagen como portada del producto' name='data[ProductoImagen][" + NuevaImagenID + "][portada]'>";
	NuevaImagenHTML += "	</td>";
	NuevaImagenHTML += "</tr>";

	$("table#lista-imagenes").append(NuevaImagenHTML);

}