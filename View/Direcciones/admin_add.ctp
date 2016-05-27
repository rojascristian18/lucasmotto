<div class="page-title">
	<h2><span class="fa fa-list"></span> Direcciones</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nuevo Direccion</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Direccion', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('comuna_id', 'Comuna'); ?></th>
						<td><?= $this->Form->input('comuna_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('tipo_direccion_id', 'Tipo direccion'); ?></th>
						<td><?= $this->Form->input('tipo_direccion_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('cliente_id', 'Cliente'); ?></th>
						<td><?= $this->Form->input('cliente_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('calle', 'Calle'); ?></th>
						<td><?= $this->Form->input('calle'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('pasaje', 'Pasaje'); ?></th>
						<td><?= $this->Form->input('pasaje'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('block_edificio', 'Block edificio'); ?></th>
						<td><?= $this->Form->input('block_edificio'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('numero', 'Numero'); ?></th>
						<td><?= $this->Form->input('numero'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('departamento', 'Departamento'); ?></th>
						<td><?= $this->Form->input('departamento'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('codigo_postal', 'Codigo postal'); ?></th>
						<td><?= $this->Form->input('codigo_postal'); ?></td>
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
