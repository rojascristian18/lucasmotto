<div id="contacto">
	<div class="container container-page">
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle">Contacto</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-container">
					
					<h4 class="contacto-subtitle">Formulario de contacto</h4>

					<?= $this->Form->create('Pagina', array('action' => 'contacto','class' => 'form')); ?>
					<div class="form-block">
					<?= $this->Form->input('nombre', array('class' => 'form-control' , 'placeholder' => 'Nombre')); ?>
					</div><!--
					--><div class="form-block">
					<?= $this->Form->input('apellido', array('class' => 'form-control' , 'placeholder' => 'Apellido')); ?>
					</div><!--
					--><div class="form-block">
					<?= $this->Form->input('email', array('class' => 'form-control', 'type' => 'email' , 'placeholder' => 'Email')); ?>
					</div><!--
					--><div class="form-block">
					<?= $this->Form->input('fono', array('class' => 'form-control' , 'placeholder' => 'Fono')); ?>
					</div><!--
					--><div class="form-block-full">
					<?= $this->Form->input('mensaje', array('class' => 'form-control' , 'placeholder' => 'Comentarios', 'type' => 'textarea')); ?>
					</div><!--
					--><div class="form-block-full">
					<?= $this->Form->button('Enviar', array('type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit')); ?>
					</div><!--
					--><div class="form-block">
					<?= $this->Form->end(); ?>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="informacion-container">
						<? foreach ($contenidos as $contenido) { ?>
							<div class="block">
								<h4 class="contacto-subtitle"><?= $contenido['Contenido']['nombre']; ?></h4>
								<p class="contacto-text"><?= $contenido['Contenido']['contenido']; ?></p>
							</div>
						<? }?>
					</div>
			</div>
		</div>
	</div>
</div>