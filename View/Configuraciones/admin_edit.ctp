<div class="page-title">
	<h2><span class="fa fa-cogs"></span> Información del sitio</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editar información</h3>
	</div>
	<div class="panel-body">
		<p class="important">* Todos los campos son opcionales</p>
		<p class="important">** Ingrese los números de teléfono sin el código de país (+56 en caso de Chile).</p>
		<div class="table-responsive">
			<?= $this->Form->create('Configuracion', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<?= $this->Form->input('id'); ?>
					<tr>
						<th><?= $this->Form->label('telefono', 'Teléfono 1 **'); ?></th>
						<td><?= $this->Form->input('telefono'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('telefono2', 'Teléfono 2 **'); ?></th>
						<td><?= $this->Form->input('telefono2'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('direccion', 'Dirección'); ?></th>
						<td><?= $this->Form->input('direccion'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('contenido1', 'Texto paso 1'); ?></th>
						<td><?= $this->Form->input('contenido1'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('contenido2', 'Texto paso 2'); ?></th>
						<td><?= $this->Form->input('contenido2'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('contenido3', 'Texto paso 3'); ?></th>
						<td><?= $this->Form->input('contenido3'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('contenido4', 'Texto paso 4'); ?></th>
						<td><?= $this->Form->input('contenido4'); ?></td>
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
