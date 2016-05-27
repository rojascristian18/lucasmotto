<div class="page-title">
	<h2><span class="fa fa-excahnge"></span> Solicitudes</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nueva Solicitud</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Transaccion', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('cliente_id', 'Cliente'); ?></th>
						<td><?= $this->Form->input('cliente_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('estado_transaccion_id', 'Estado transaccion'); ?></th>
						<td><?= $this->Form->input('estado_transaccion_id', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('creada', 'Fecha Creación'); ?></th>
						<td><?= $this->Form->input('creada', array('class' => 'fecha form-control')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('valor', 'Valor del Crédito'); ?></th>
						<td><?= $this->Form->input('valor', array('class' => 'form-control select')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('Documento', 'Documentos Solicitados'); ?></th>
						<td><?= $this->Form->input('Documento'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('Producto', 'Productos Solicitados'); ?></th>
						<td><?= $this->Form->input('Producto'); ?></td>
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
