<div class="page-title">
	<h2><span class="fa fa-cogs"></span> Inofrmación del sitio</h2>
</div>

<div class="page-content-wrap">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Información</h3>
			<?php foreach ( $configuraciones as $configuracion ) : ?>
			<div class="btn-group pull-right">
				<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $configuracion['Configuracion']['id']), array('class' => 'btn btn-md btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<td><b>Teléfono 1</b></td><td><?= h($configuracion['Configuracion']['telefono']); ?>&nbsp;</td>
						</tr>
						<tr>
							<td><b>Teléfono 2</b></td><td><?= h($configuracion['Configuracion']['telefono2']); ?>&nbsp;</td>
						</tr>
						<tr>
							<td><b>Dirección</b></td><td><?= h($configuracion['Configuracion']['direccion']); ?>&nbsp;</td>
						</tr>
						<tr>
							<td><b>Texto paso 1</b></td><td><?= h($configuracion['Configuracion']['contenido1']); ?>&nbsp;</td>
						</tr>
						<tr>
							<td><b>Texto paso 2</b></td><td><?= h($configuracion['Configuracion']['contenido2']); ?>&nbsp;</td>
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
