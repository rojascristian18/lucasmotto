	<div class="panel-body">
		<h2>Detalle de la solicitud</h2>
		<div class="table-color">
			<h3 class="title">Datos del Cliente</h3>
				<table>
					<tr>
						<td>Rut</td>
						<td><?= $solicitud['Cliente']['rut']; ?></td>
					</tr>
					<tr>
						<td>Nombre</td>
						<td><?= $solicitud['Cliente']['nombre'] . " " . $solicitud['Cliente']['apellido_paterno'] . " " . $solicitud['Cliente']['apellido_materno']; ?></td>
					</tr>
					<tr>
						<td>Fecha de Nacimiento</td>
						<td><?= $solicitud['Cliente']['fecha_nacimiento']; ?></td>
					</tr>
				</table>
			<h3 class="title">Datos del la solicitud</h3>
				<table>
					<tr>
						<td>Monto solicitado</td>
						<td><?=$this->Number->currency($solicitud['Transaccion']['valor'], '$ ', array('thousands' => '.', 'places' => '0')) . ' Pesos'; ?></td>
					</tr>
					<tr>
						<td>Creada</td>
						<td><?= $solicitud['Transaccion']['creada']; ?></td>
					</tr>
					<tr>
						<td>Estado de la solicitud</td>
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
				<table>
					<tr>
						<td class="subtitle">Nombre</td>
						<td class="subtitle">Modelo</td>
					</tr>
					<? foreach ($solicitud['Producto'] as $producto) { ?>
						<tr>
							<td><?=$producto['nombre']; ?></td>
							<td><?=$producto['Modelo']['nombre']; ?></td>
						</tr>
					<? } ?>
				</table>
			<h3 class="title">Documentos Solicitados</h3>
				<table>
					<tr>
						<td class="subtitle">Nombre</td>
						<td class="subtitle">Tipo de documento</td>
					</tr>
					<? foreach ($solicitud['Documento'] as $documento) { ?>
						<tr>
							<td><?= $documento['nombre'];?></td>
							<td><?= $documento['TipoDocumento']['nombre'];?></td>
						</tr>
				<?	} ?>
				</table>
		</div>
	</div>