<div class="page-title">
	<h2><span class="fa fa-exchange"></span> Solicitudes</h2>
</div>

<div class="page-content-wrap">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-4">
					<h3 class="panel-title">Listado de Solicitudes</h3>
				</div>
				<div class="col-md-4">
					<?= $this->Form->create('Transaccion', array('action' => 'search','class' => 'form-inline')); ?>
						<input name="data[Transaccion][rut]" class="form-control" value="" id="TransaccionRut" type="text" placeholder="Ingrese Rut de Cliente">
						<button type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Buscando..." >Buscar</button>

					<?= $this->Form->end(); ?>
				</div>
				<div class="col-md-4">
					<div class="btn-group pull-right">
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nueva Soicitud', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr class="sort">
							<th><?= $this->Paginator->sort('cliente_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('estado_transaccion_id', 'Estado Solicitud', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('valor', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('creada', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php 	if(!empty($transacciones)){

									foreach ( $transacciones as $transaccion ) : ?>

										<tr>
											<td><?= $this->Html->link($transaccion['Cliente']['nombre'], array('controller' => 'clientes', 'action' => 'profile', $transaccion['Cliente']['id'])); ?></td>
											<td><?= h($transaccion['EstadoTransaccion']['nombre']); ?></td>
											<td><?= "$ ". h($transaccion['Transaccion']['valor']); ?>&nbsp;</td>
											<td><?= h($transaccion['Transaccion']['creada']); ?>&nbsp;</td>
											<td>
												<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $transaccion['Transaccion']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
												<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $transaccion['Transaccion']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
											</td>
										</tr>

									<?php endforeach; 

								}	?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="pull-right">
	<ul class="pagination">
		<?= $this->Paginator->prev('« Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'first disabled hidden')); ?>
		<?= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'modulus' => 2, 'currentClass' => 'active', 'separator' => '')); ?>
		<?= $this->Paginator->next('Siguiente »', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'last disabled hidden')); ?>
	</ul>
</div>
