<div class="page-title">
	<h2><span class="fa fa-exchange"></span> Solicitudes</h2>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Solicitud N° <?= $solicitud['Transaccion']['id'];  ?></h3>
		<?= $this->Form->postLink('<i class="fa fa-file-pdf-o"></i> Crear PDF', array('action' => 'generarPdf', $solicitud['Transaccion']['id'], 'ext' => 'pdf'), array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
	</div>
	<div class="panel-body">
		<div class="table-responsive table-color">
			<h3 class="title">Datos del Cliente</h3>
				<table class="table">
					<tr>
						<th>Rut</th>
						<td><?= $solicitud['Cliente']['rut']; ?></td>
					</tr>
					<tr>
						<th>Nombre</th>
						<td><? echo $solicitud['Cliente']['nombre'] . " " . $solicitud['Cliente']['apellido_paterno'] . " " . $solicitud['Cliente']['apellido_materno']?></td>
					</tr>
					<tr>
						<th>Fecha de Nacimiento</th>
						<td><?= $solicitud['Cliente']['fecha_nacimiento']; ?></td>
					</tr>
					<tr>
						<th>Ver perfil completo</th>
						<td><?= $this->Html->link('<i class="fa fa-eye"></i> Ver', array('controller' => 'clientes', 'action' => 'profile', $solicitud['Cliente']['id']), array('class' => 'btn btn-success', 'escape' => false)); ?></td>
					</tr>
				</table>
			<h3 class="title">Datos del la solicitud</h3>
				<table class="table">
					<tr>
						<th>Monto solicitado</th>
						<td><? 	echo $this->Number->currency($solicitud['Transaccion']['valor'], '$ ', array('thousands' => '.', 'places' => '0')) . ' Pesos'; ?></td>
					</tr>
					<tr>
						<th>Creada</th>
						<td><? echo $solicitud['Transaccion']['creada']; ?></td>
					</tr>
					<tr>
						<th>Estado de la solicitud</th>
						<? if($solicitud['EstadoTransaccion']['id'] == "1"){
									echo "<td class='text-success'><b>" . $solicitud['EstadoTransaccion']['nombre'] . "</b></td>";
								}

								if($solicitud['EstadoTransaccion']['id'] == "2"){
									echo "<td class='text-danger'><b>" . $solicitud['EstadoTransaccion']['nombre'] . "</b></td>";
								}

								if($solicitud['EstadoTransaccion']['id'] == "3"){
									echo "<td class='text-warning'><b>" . $solicitud['EstadoTransaccion']['nombre'] . "</b></td>";
								}
						?>
					</tr>
				</table>
			<h3 class="title">Productos Solicitados</h3>
				<table class="table">
					<tr>
						<th>Nombre</th>
						<th>Modelo</th>
					</tr>
					<? foreach ($solicitud['Producto'] as $producto) { ?>
						<tr>
							<td><?=$producto['nombre']; ?></td>
							<td><?=$producto['Modelo']['nombre']; ?></td>
						</tr>
					<? } ?>
				</table>
			<h3 class="title">Documentos Solicitados</h3>
				<table class="table">
					<tr>
						<th>Nombre</th>
						<th>Tipo de documento</th>
						<th>Descargar</th>
					</tr>
					<? foreach ($solicitud['Documento'] as $documento) { ?>
						<tr>
							<td><?= $documento['nombre'];?></td>
							<td><?= $documento['TipoDocumento']['nombre'];?></td>
							<td><?= $this->Html->link(
									'<i class="fa fa-download"></i> Descargar',
									sprintf('/img/Documento/%s', $documento['id'] . "/" . $documento['ruta']),
									array(
										'class' => 'btn btn-info', 
										'target' => '_blank', 
										'fullbase' => true,
										'escape' => false
									)); ?>&nbsp;</td>
						</tr>
				<?	} ?>
				</table>
		</div>
	</div>
</div>