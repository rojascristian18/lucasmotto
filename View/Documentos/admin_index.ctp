<div class="page-title">
	<h2><span class="fa fa-file-text-o"></span> Documentos</h2>
</div>

<div class="page-content-wrap">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Listado de Documentos</h3>
			<div class="btn-group pull-right">
				<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Documento', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
				<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr class="sort">
							<th><?= $this->Paginator->sort('nombre', 'Nombre', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('ruta', 'Archivo', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th><?= $this->Paginator->sort('tipo_documento_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $documentos as $documento ) : ?>
						<tr>
							<td><?= h($documento['Documento']['nombre']); ?>&nbsp;</td>
							<td><?= $this->Html->link(
									'Ver Documento',
									sprintf('/img/%s',$documento['Documento']['ruta']['path']),
									array(
										'class' => 'button', 
										'target' => '_blank', 
										'fullbase' => true
									)); ?>&nbsp;</td>

							<td><?= $this->Html->link($documento['TipoDocumento']['nombre'], array('controller' => 'tipo_documentos', 'action' => 'edit', $documento['TipoDocumento']['id'])); ?></td>
							<td>
								<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $documento['Documento']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
								<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $documento['Documento']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
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
