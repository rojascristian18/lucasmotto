<?= $this->Html->script(array('admin_productos'), array('inline' => false)); ?>
<div class="page-title">
	<h2><span class="fa fa-motorcycle"></span> Motocicletas</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nueva Motocicleta</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Producto', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<div class="container-fluid">
						<div class="row">
							<h3 class="title">Información</h3>
							<div class="col-md-6">
								<table class="table">
									<tr>
										<th><?= $this->Form->label('modelo_id', 'Modelo'); ?></th>
										<td><?= $this->Form->input('modelo_id', array('class' => 'form-control select')); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('tipo_producto_id', 'Categoría'); ?></th>
										<td><?= $this->Form->input('tipo_producto_id', array('class' => 'form-control select')); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
										<td><?= $this->Form->input('nombre'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('valor', 'Precio (Sin puntos)'); ?></th>
										<td><?= $this->Form->input('valor'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('valor_oferta', 'Precio Oferta (Sin puntos)'); ?></th>
										<td><?= $this->Form->input('valor_oferta'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('cuotas', 'Cuotas'); ?></th>
										<td><?= $this->Form->input('cuotas'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('fecha_vencimiento', 'Fecha de Vencimiento'); ?></th>
										<td><?= $this->Form->input('fecha_vencimiento', array('class' => 'form-control fecha')); ?></td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table">
									<tr>
										<th><?= $this->Form->label('destacado', 'Motocicleta destacada'); ?></th>
										<td><?= $this->Form->input('destacado', array('class' => 'icheckbox')); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('estatus', 'Vigente'); ?></th>
										<td><?= $this->Form->input('estatus', array('class' => 'icheckbox')); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('descripcion', 'Descripción'); ?></th>
										<td><?= $this->Form->input('descripcion'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('Proveedor', 'Distribuidores'); ?></th>
										<td><?= $this->Form->input('Proveedor'); ?></td>
									</tr>
									<tr>
										<th><?= $this->Form->label('ruta_documento', 'Ficha Producto'); ?></th>
										<td><?= $this->Form->file('ruta_documento'); ?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<h3 class="title">Productos Relacionados</h3>
							<div class="col-md-12">
								<table class="table">
									<tr>
										<th><?= $this->Form->label('relacionados', 'Seleccione'); ?></th>
										<td><select name="data[Relacionado][][producto_relacionado_id]" multiple="multile" class="form-control" id="relacionados">
										<? foreach ($relacionados as $relacionado) {
											echo "<option value='".$relacionado['Producto']['id']."'>";
											echo $relacionado['Producto']['nombre'];
											echo "</option>";
										}?></select></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<h3 class="title">Especificaciones</h3>
							<div class="col-md-12">
								<table class="table">
								<? foreach ($EspecificacionCategorias as $cont => $EspecificacionCategoria) {
									echo "<tr><td><label>" . $EspecificacionCategoria['Categoria']['nombre'] . "</label></td>";
									echo "<td><select name=data[Especificacion][Especificacion][] class='form-control' id='select" . $cont . "'>";
									echo "<option value=''>Seleccione</option>";
										foreach ($EspecificacionCategoria['Especificacion'] as $index => $especificacion) {

											echo "<option value='" . $especificacion['id'] . "'>" . $especificacion['nombre'] . "</option>";
										}
									echo "</select></td>";
									echo "</tr>";
								} ?>
								</table>
							</div>
						</div>
						<div class="row">
							<h3 class="title">Imágenes</h3>
							<div class="col-md-12">
								<h4 class="subtitle">Imágen Principal</h4>
								<? if (empty($imagenes)) { ?>

									<div class="bg-notfound">Esta motocicleta no tiene imágenes</div>
									
								<? }else{

									$imageHTML = 	"";
									$galleryHTML =	"";
									foreach ($imagenes as $indice => $imagen) {

										if ($imagen['portada'] == '1') {

											$imageHTML = 	"<div class='image-exist'>";
											$imageHTML .=	"<a class='delete-image' onclick='quitarImagenPrincipal(this, ".$imagen['id'].");'><i class='fa fa-trash'></i></a>";	
											$imageHTML .= 	$this->Html->image(
																				'ImagenProducto/' . $imagen['id'] . '/mini_' . $imagen['nombre']
																				);
											$imageHTML .= 	"</div>";

											echo $imageHTML;
											
										}else{
		
											$galleryHTML .= 	"<div class='image-exist'>";
											$galleryHTML .=		"<a class='delete-image' onclick='quitarImagenes(this, ".$imagen['id'].");'><i class='fa fa-trash'></i></a>";	
											$galleryHTML .= 	$this->Html->image(
																				'ImagenProducto/' . $imagen['id'] . '/mini_' . $imagen['nombre']
																				);
											$galleryHTML .= 	"</div>";

											

										}
											
									} 	
										echo 	"<div class='galery-container'><h4 class='subtitle'>Galería</h4>";
										echo 	$galleryHTML;
										echo 	"</div>";
								}
									?>
								<input type="hidden" id="imageneseliminadas" name="imageneseliminadas">

								<table class="table" id="lista-imagenes">
									<tr>
										<td><h4 class="subtitle">Agregar nuevas imágenes</h4></td>
										<td align="right"><a class="btn btn-defaut" onclick="Admin_Imagenes_AgregarOtraImagen();" title="Agregar Otra Imágen"><i class="fa fa-plus"></i> Agregar Otra</a></td>
									</tr>
									<tr>
										<td><?= $this->Form->input('ImagenProducto.0.nombre', array('data-model' => 'ImagenProducto', 'data-field' => 'portada', 'type' => 'file', 'class' => '')); ?></td>
										<td>Principal: <?= $this->Form->input('ImagenProducto.0.portada', array('class' => 'icheckbox', 'title' => 'Marque para asignar la imagen como portada del producto', 'style' => 'position: absolute; margin-left: 5px;')); ?></td>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
					</div> <!-- Edn div.container-fluid -->

				<div class="pull-right">
					<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
					<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
				</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>