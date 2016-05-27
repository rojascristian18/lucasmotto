<div class="page-title">
	<h2><span class="fa fa-list-ol"></span> Logs</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editar Log</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Log', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<?= $this->Form->input('id'); ?>
					<tr>
						<th><?= $this->Form->label('fecha', 'Fecha'); ?></th>
						<td><?= $this->Form->input('fecha'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('accion_id', 'Accion'); ?></th>
						<td><?= $this->Form->input('accion_id', array('class' => 'form-control select')); ?></td>
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
