<div class="panel-body">
	<h2 class="title">Perfil de Cliente</h2>
	
	<div class="table-color">
			<h3 class="title">Datos Personales</h3>
			<table class="table">
				<tr>
					<td>Nombre completo</td>
					<td><? echo $cliente['Cliente']['nombre'] . " " . $cliente['Cliente']['apellido_paterno'] . " " . $cliente['Cliente']['apellido_materno']?></td>
				</tr>
				<tr>
					<td>Rut</td>
					<td><? echo $cliente['Cliente']['rut']; ?></td>
				</tr>
				<tr>
					<td>Fecha de nacieminto</td>
					<td><? echo $cliente['Cliente']['fecha_nacimiento']; ?></td>
				</tr>
				<tr>
					<td>Estado Civil</td>
					<td><? echo $cliente['EstadoCivil']['nombre']; ?></td>
				</tr>
			</table>
	</div> <!-- End Div.table -->

	<div class="table-responsive table-color">
		<h3 class="title">Datos Laborales</h3>
		<table class="table">
			<tr>
				<td>Situación Laboral</td>
				<td><? echo 'Trabajador ' . $cliente['TipoCliente']['nombre']; ?></td>
			</tr>
			<tr>
				<td>Ingreso Bruto mensual</td>
				<td><? 	echo $this->Number->currency($cliente['Cliente']['ingresos'], '$ ', array('thousands' => '.', 'places' => '0')) . ' Pesos'; ?></td>
			</tr>
		</table>
	</div> <!-- End Div.table -->

	<div class="table-responsive table-color">
			<h3 class="title">Datos de Contacto</h3>
			<table class="table">
				<tr>
					<td>Teléfono</td>
					<td><? echo $cliente['Cliente']['fono']; ?></td>
				</tr>
				<tr>
					<td>Teléfono Laboral</td>
					<td><? echo $cliente['Cliente']['tel_laboral']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><? echo $cliente['Cliente']['email']; ?></td>
				</tr>
				<? foreach ($direcciones as $direccion) { ?>
					<tr><td colspan="2" class="subtitle"><b>Dirección <? echo $direccion['TipoDireccion']['nombre']; ?></b></td></tr>
					<tr><td>Calle</td><td><? echo $direccion['Direccion']['calle']; ?></td></tr>
					<tr><td>Pasaje</td><td><? echo $direccion['Direccion']['pasaje']; ?></td></tr>
					<tr><td>Block/Edificio</td><td><? echo $direccion['Direccion']['block_edificio'];; ?></td></tr>
					<tr><td>Número</td><td><? echo $direccion['Direccion']['numero']; ?></td></tr>
					<tr><td>Departamento/Oficina</td><td><? echo $direccion['Direccion']['departamento']; ?></td></tr>
					<tr><td>Comuna</td><td><? echo $direccion['Comuna']['nombre']; ?></td></tr>
					<tr><td>Región</td><td><? echo $direccion['Comuna']['Region']['nombre']; ?></td></tr>
				<? } ?>
			</table>
	</div> <!-- End Div.table -->


	<div class="table-responsive table-color">
		<h3 class="title">Solicitudes</h3>
		<table class="table">
			<? foreach ($transacciones as $transaccion) { ?>
				<tr>
					<td colspan="2" class="subtitle"><b>Identificador #<? echo $transaccion['Transaccion']['id']; ?></b></td>
			
				</tr>
				<tr>
					<td>Estado de la solicitud</td>
					<? if($transaccion['EstadoTransaccion']['id'] == "1"){
								echo "<td class='text-success'><b>" . $transaccion['EstadoTransaccion']['nombre'] . "</b></td>";
						}

						if($transaccion['EstadoTransaccion']['id'] == "2"){
								echo "<td class='text-danger'><b>" . $transaccion['EstadoTransaccion']['nombre'] . "</b></td>";
						}

						if($transaccion['EstadoTransaccion']['id'] == "3"){
								echo "<td class='text-warning'><b>" . $transaccion['EstadoTransaccion']['nombre'] . "</b></td>";
						}
					 ?>
				</tr>
				<tr>
					<td>Monto de la solicitud</td>
					<td><? echo $this->Number->currency($transaccion['Transaccion']['valor'], '$ ', array('thousands' => '.', 'places' => '0')) . ' Pesos'; ?></td>
				</tr>
				<tr>
					<td>Fecha creación</td>
					<td><? echo $transaccion['Transaccion']['creada']; ?></td>
				</tr>
			<? } ?>
		</table>
	</div>

</div><!-- End Div.table -->

</div>
