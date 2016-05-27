
<div id="view-container">
	<div class="container container-page">
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle"><?= $producto['Producto']['nombre'] . " / <span>" . $producto['Modelo']['nombre'] ; ?></span></h3>
			</div>
		</div>
		<div class="row">
			<!-- Gallery View For Desktop -->
			<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs">

				<div class="container-image">
					<? foreach ($producto['ImagenProducto'] as $imagen) {
						
						if ($imagen['portada'] == 1) {
							echo "<div class='imagen-principal'>";
							echo $this->Html->image( 'ImagenProducto/'. $imagen['id'] . '/principal_' . $imagen['nombre'], array('class' => 'zoomImage' ));
							echo "</div>";
						}
							echo "<div class='imagen-galeria'>";
							echo $this->Html->image( 'ImagenProducto/'. $imagen['id'] . '/galeria_' . $imagen['nombre'], array('onclick' => 'showImage(this);' , 'data-image' => 'ImagenProducto/'. $imagen['id'] . '/principal_' . $imagen['nombre']));
							echo "</div>";

					} ?>
				</div>
				<div class="zoom">
				</div>

			</div>

			<!-- Gallery View For Mobile Device -->
			<div class="col-xs-12 visible-xs">
				<div id="carousel-view" class="carousel slide" data-ride="carousel">
				<? 	$indicadoresHTML = ""; 
					$slidHTML = "";
					$contador = 0;
				foreach ($producto['ImagenProducto'] as $imagen) {

					if ($contador == 0) {
						$indicadoresHTML .= "<li data-target='#carousel".$imagen['id']."' data-slide-to='".$contador."' class='active'></li>";
						$slidHTML .= "<div class='item active'>";
						$slidHTML .= $this->Html->image( 'ImagenProducto/'. $imagen['id'] . '/principal_' . $imagen['nombre'], array('class' => 'responsive-img' ));
						$slidHTML .= "</div>";
					}else{
						$indicadoresHTML .= "<li data-target='#carousel".$imagen['id']."' data-slide-to='".$contador."' ></li>";
						$slidHTML .= "<div class='item'>";
						$slidHTML .= $this->Html->image( 'ImagenProducto/'. $imagen['id'] . '/principal_' . $imagen['nombre'], array('class' => 'responsive-img' ));
						$slidHTML .= "</div>";
					}

				$contador++;
				}?>
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					    <?= $indicadoresHTML; ?>
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					    <?= $slidHTML; ?>
					  </div>

					  <!-- Controls -->
					  <a class="left carousel-control" href="#carousel-view" role="button" data-slide="prev">
					    <span class="fa fa-chevron-left vertical-center"></span>
					  </a>
					  <a class="right carousel-control" href="#carousel-view" role="button" data-slide="next">
					    <span class="fa fa-chevron-right vertical-center"></span>
					  </a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			
				<div class="description-container">
					<p><?= $producto['Producto']['descripcion']; ?></p>	
				</div>
				<?php foreach ($producto['Especificacion'] as $especificacion): 
							if ($especificacion['destacado'] == 1) {
								echo "<div class='especificacion-container'>";
								echo "<i class='fa fa-check'></i> ";
								echo "<label>" . $especificacion['nombre'] . "</label>";
								echo "</div>";
							}
					endforeach ?>
				<div class="precio-container">
				<? if ( !empty($producto['valor_oferta']) && $todayIs <= $producto['fecha_vencimiento'] ) { ?>
					
					<label>Precio</label>
					<span class='price subrayado'><? echo $this->Number->currency($producto['Producto']['valor'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
					</span>

					<label>Precio Oferta</label>
					<span class='price oferta'><? echo $this->Number->currency($producto['Producto']['valor_oferta'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
					</span>

				<? }else{ ?>
					
						<label>Precio</label>
						<span class='price'><? echo $this->Number->currency($producto['Producto']['valor'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
						</span>
				
				<?	} ?>
					
				</div>

			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<?= $this->element('formulario'); ?>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle">
					Ficha Técnica
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<? $this->set(compact('categoriaPadres')); ?>
				<?= $this->element('ficha_tecnica'); ?>
			</div>
		</div>
		<div class="row">
			<? $this->set(compact('relacionados')); ?>
			<?= $this->element('relacionados'); ?>
		</div>
	</div>
</div>