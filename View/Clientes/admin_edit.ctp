<div class="page-title">
	<h2><span class="fa fa-list"></span> Clientes</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Cliente</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Cliente', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<?= $this->Form->input('id'); ?>
					<tr>
						<th><?= $this->Form->label('tipo_cliente_id', 'Tipo cliente'); ?></th>
						<td><?= $this->Form->input('tipo_cliente_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('estado_civil_id', 'Estado civil'); ?></th>
						<td><?= $this->Form->input('estado_civil_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
						<td><?= $this->Form->input('nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('rut', 'Rut'); ?></th>
						<td><?= $this->Form->input('rut'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('apellido_paterno', 'Apellido paterno'); ?></th>
						<td><?= $this->Form->input('apellido_paterno'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('apellido_materno', 'Apellido materno'); ?></th>
						<td><?= $this->Form->input('apellido_materno'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('fecha_nacieminto', 'Fecha nacieminto'); ?></th>
						<td><?= $this->Form->input('fecha_nacieminto'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('email', 'Email'); ?></th>
						<td><?= $this->Form->input('email'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('fono', 'Fono'); ?></th>
						<td><?= $this->Form->input('fono'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('tel_laboral', 'Tel laboral'); ?></th>
						<td><?= $this->Form->input('tel_laboral'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('ingresos', 'Ingresos'); ?></th>
						<td><?= $this->Form->input('ingresos'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('clave', 'Clave'); ?></th>
						<td><?= $this->Form->input('clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('estatus', 'Estatus'); ?></th>
						<td><?= $this->Form->input('estatus'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('last_login', 'Last login'); ?></th>
						<td><?= $this->Form->input('last_login'); ?></td>
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
