<div class="form-container">
	<div class="form-header">
		<h4>Lorem ipsum dolor sit amet, consectetur adipiscing</h4>
	</div>
	<div class="form-body">
	
		<?= $this->Form->create('Transaccion', array('action' => 'solicitud','class' => 'form')); ?>
		<?= $this->Form->input('Cliente.nombre', array('class' => 'form-control' , 'placeholder' => 'Nombre')); ?>
		<?= $this->Form->input('Cliente.rut', array('class' => 'form-control' , 'placeholder' => 'Rut sin puntos')); ?>
		<?= $this->Form->input('Cliente.email', array('class' => 'form-control', 'type' => 'email' , 'placeholder' => 'Email')); ?>
		<?= $this->Form->input('Cliente.fono', array('class' => 'form-control' , 'placeholder' => 'Fono', 'type' => 'text' )); ?>
		<?= $this->Form->input('producto_id', array('type' => 'hidden' , 'value' => $producto['Producto']['id'])); ?>
		<?= $this->Form->input('slug', array('type' => 'hidden' , 'value' => $producto['Producto']['slug'])); ?>
		<?= $this->Form->input('valor', array('type' => 'hidden' , 'value' => $producto['Producto']['valor'])); ?>
		<?= $this->Form->button('Solicitar', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
		<?= $this->Form->end(); ?>	
	
	</div>
</div>