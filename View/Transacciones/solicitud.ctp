<div id="solicitud">
	<div class="container container-page">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title"><i class="fa fa-check"></i> Felicidades</h2>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3 class="subtitle">Su solicitud N° <?= $solicitud; ?> fue creada con éxito.</h3>
				<p>Hemos enviado un email con el documento que debe presentar al momento de ir a su distribuidor o puede descargarlo directamente aquí:</p>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= $this->Html->link('<i class="fa fa-file-pdf-o"></i> Descargar PDF', array('action' => 'generarPdfSolicitud', $solicitud, 'ext' => 'pdf'), array('class' => 'btn btn-danger btn-lg pull-right', 'escape' => false)); ?>
				<?= $this->Html->link('<i class="fa fa-arrow-left"></i> Volver', array('controller' => 'transacciones', 'action' => 'quit'), array('class' => 'btn btn-lg btn-success pull-left', 'rel' => 'tooltip', 'title' => 'Volver', 'escape' => false)); ?>
			</div>
		</div>
	</div>
</div>
