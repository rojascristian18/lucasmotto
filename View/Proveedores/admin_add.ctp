<div class="page-title">
	<h2><span class="fa fa-list"></span> Proveedores</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nuevo Proveedor</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Proveedor', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
						<td><?= $this->Form->input('nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('direccion', 'Dirección'); ?></th>
						<td><?= $this->Form->input('direccion'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('fono', 'Fono'); ?></th>
						<td><?= $this->Form->input('fono'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('email', 'Email'); ?></th>
						<td><?= $this->Form->input('email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('sitio_web', 'Sitio Web'); ?></th>
						<td><?= $this->Form->input('sitio_web'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('region_id', 'Región'); ?></th>
						<td><?= $this->Form->input('region_id', array('class' => 'form-control select')); ?></td>
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
