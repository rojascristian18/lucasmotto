<div class="page-title">
	<h2><span class="fa fa-picture-o"></span> Imágenes</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nueva Imágen</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Imagen', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('slider_posicion_id', 'Ubicación'); ?></th>
						<td><?= $this->Form->input('slider_posicion_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
						<td><?= $this->Form->input('nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('descripcion', 'Descripcion'); ?></th>
						<td><?= $this->Form->input('descripcion'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('ruta', 'Imágen'); ?></th>
						<td><?= $this->Form->input('ruta', array('type' => 'file', 'class' => '')); ?></td>
					</tr>
				</table>

				<div class="pull-right">
					<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
					<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
				</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>
