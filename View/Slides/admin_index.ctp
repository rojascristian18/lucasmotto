<div class="page-title">
	<h2><span class="fa fa-list"></span> Slides</h2>
</div>

<div class="page-content-wrap">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Listado de Slides</h3>
			<div class="btn-group pull-right">
				<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Slid', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
				<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr class="sort">
							<th><?= $this->Paginator->sort('ruta', 'Imágen', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>

							<th><?= $this->Paginator->sort('slider_id', 'Pertenece a', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('link', 'Link a', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $slides as $slid ) : ?>
						<tr>
							<td><?= $this->Html->image($slid['Slid']['ruta']['mini']); ?>&nbsp;</td>
							<td><?= h($slid['Slid']['nombre']); ?>&nbsp;</td>
							<td><?= h($slid['Slider']['nombre']); ?>&nbsp;</td>
							<td><?= h($slid['Slid']['link']); ?>&nbsp;</td>
							<td>
								<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $slid['Slid']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
								<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $slid['Slid']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
							</td>
						</tr>
						<?php endforeach; ?>
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
