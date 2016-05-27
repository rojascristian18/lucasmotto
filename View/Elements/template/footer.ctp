<? 
		$tel1 = "";
		$tel2 = "";
		$direccion = "";

		foreach ($info as $configuracion) {
			$tel1 = $configuracion['telefono'];
			$tel2 = $configuracion['telefono2'];
			$direccion = $configuracion['direccion'];
		}
?>

<div id="footer">
	<div class="container container-page">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<?= $this->Html->image($logoHome['Imagen']['ruta']['path'] , array('class' => 'logo')); ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<ul class="unlist">
					<li><?=	$this->Html->link(
                                           'Quiénes Somos',
                                           array('controller' => 'paginas', 'action' => 'quienes_somos'),
                                           array('escape' => false, 'class' => 'link')
                                       ); ?>
                    </li>
                    <li><?=	$this->Html->link(
                                           'Preguntas Frecuentes',
                                           array('controller' => 'preguntas-frecuentes', 'action' => 'index'),
                                           array('escape' => false, 'class' => 'link')
                                       ); ?>
                    </li>
                    <li><?=	$this->Html->link(
                                           'Contacto',
                                           array('controller' => 'paginas', 'action' => 'contacto'),
                                           array('escape' => false, 'class' => 'link')
                                       ); ?>
                    </li>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<h4>Teléfonos</h4>
					<ul class="unlist">
						<li><a href="tel:" class="link"><?= $tel1; ?></a></li>
						<li><a href="tel:" class="link"><?= $tel2; ?></a></li>	
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<h4>Dirección</h4>
				<p><?= $direccion; ?></p>
				<h4><?=	$this->Html->link(
			           'Intranet',
			           array('controller' => 'admin', 'action' => ''),
			           array('escape' => false, 'class' => 'link', 'target' => '_blank')
				); ?>
				</h4>
			</div>
		</div>
	</div>
</div>

<?= $this->element('/template/modal'); ?>