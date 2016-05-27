<? 	$contador = 1;
	$primerContenido = "";
	$segundoContenido = "";
	$tercerContenido = "";
	$cuartoContenido = ""; ?>

<? 	foreach ($contenidos as $contenido) {
		if ($contador == 1) {
			$primerContenido .= "<p>" . $contenido['Contenido']['contenido'] . "</p>";
		}

		if ($contador == 2) {
			$segundoContenido .= "<p>" . $contenido['Contenido']['contenido'] . "</p>";
		}

		if ($contador == 3) {
			$tercerContenido .= "<p>" . $contenido['Contenido']['contenido'] . "</p>";
		}

		if ($contador == 4) {
			$cuartoContenido .= "<p>" . $contenido['Contenido']['contenido'] . "</p>";
		}

		$contador++;

	}?>
<div id="quienes-somos">
	<div class="container container-page">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h3 class="subtitle">¿Quiénes Somos?</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<?= $this->Html->image($imagenPrincipal['Imagen']['ruta']['principal'], array('class' => 'responsive-img')); ?>
			</div>
			<div class="col-md-6 col-xs-12">
				<?= $primerContenido; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="contenido">
					<?= $segundoContenido; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="contenido2">
					<?= $tercerContenido;?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="contenido text-center">
					<?= $this->Html->image($logoHome['Imagen']['ruta']['path'] , array('class' => 'logo')); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->Html->image($imagenFooter['Imagen']['ruta']['full'], array('class' => 'responsive-img')); ?>
			</div>
			<div class="col-md-12">
				<div class="contenido">
					<?= $cuartoContenido; ?>
				</div>
			</div>
		</div>
	</div>
</div>