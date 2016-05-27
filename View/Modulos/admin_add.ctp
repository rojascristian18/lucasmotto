<div class="page-title">
	<h2><span class="fa fa-list"></span> Modulos</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nuevo Modulo</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<?= $this->Form->create('Modulo', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
				<table class="table">
					<tr>
						<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
						<td><?= $this->Form->input('nombre'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('controlador', 'Controlador'); ?></th>

						<?  
							$options = array(); 

						 	$controladores		=  array_map(function($controlador) {

								return str_replace('Controller', '', $controlador);

							}, App::objects('controller'));

							   foreach ( $controladores as $controlador ) : 
							   if ( $controlador === 'App' ) continue; 

								 $options[strtolower($controlador)] = $controlador; 

							   endforeach; ?>
						
						<td><?= $this->Form->select('controlador', $options,array('empty' => 'Seleccione', 'class' => 'form-control')); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('icono', 'Seleccione Icono'); ?></th>
						<td><?= $this->Form->input('icono'); ?></td>
					</tr>
					<tr>
						<th><?= $this->Form->label('parent_id', 'Seleccione categoría'); ?></th>
						<td><?= $this->Form->input('parent_id', array(
								    'options' => $categorias,
								    'empty' => 'Sin categoría padre'
								)); ?>
						</td>
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
