<div class="page-title">
	<h2><span class="fa fa-list"></span> Slides</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Slid</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Slid', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<?= $this->Form->input('id'); ?>
					<tr>
						<th><?= $this->Form->label('slider_id', 'Slider'); ?></th>
						<td><?= $this->Form->input('slider_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
						<td><?= $this->Form->input('nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('', 'Imágen actual'); ?></th>
						<td><?= $this->Html->image($ImagenActual); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('ruta', 'Imágen'); ?></th>
						<td><?= $this->Form->file('ruta'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('precio_normal', 'Precio normal'); ?></th>
						<td><?= $this->Form->input('precio_normal'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('precio_oferta', 'Precio oferta'); ?></th>
						<td><?= $this->Form->input('precio_oferta'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('fecha_vencimiento', 'Fecha de vencimiento'); ?></th>
						<td><?= $this->Form->input('fecha_vencimiento', array('class' => 'fecha form-control')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('titulo', 'Titulo'); ?></th>
						<td><?= $this->Form->input('titulo'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('descripcion', 'Descripcion'); ?></th>
						<td><?= $this->Form->input('descripcion'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('link', 'Link a'); ?></th>
						<td><?= $this->Form->input('link'); ?></td>
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
