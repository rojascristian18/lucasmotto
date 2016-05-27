<div class="page-title">
	<h2><span class="fa fa-user"></span> Perfil de <? echo $cliente['Cliente']['nombre'];?></h2>
</div>
<div class="btn-group pull-right">
				<?= $this->Html->link('<i class="fa fa-file-pdf-o"></i> Crear PDF', array('action' => 'exportarPerfilCliente', $cliente['Cliente']['id'], 'ext' => 'pdf'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
			</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Aquí encontrará toda la información de su cliente.</h3>
	</div>
	<div class="panel-body">
		<div class="container-fluid">

			<div class="row">

				<div class="col-md-6">

					<div class="table-responsive table-color">
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

				</div> <!-- End Div.col -->

				<div class="col-md-6">

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
					</div>

				</div> <!-- End Div.col -->

			</div> <!-- End Div.row -->
			<div class="row">
				
				<div class="col-md-6">
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
									<tr><td colspan="2" style="background-color: #F3F3F3;"><b>Dirección <? echo $direccion['TipoDireccion']['nombre']; ?></b></td></tr>
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

				</div>

				<div class="col-md-6">

					<div class="table-responsive table-color">
						<h3 class="title">Solicitudes</h3>
						<table class="table">
							<? foreach ($transacciones as $transaccion) { ?>
								<tr>
									<td colspan="2"><b>Identificador #<? echo $transaccion['Transaccion']['id']; ?></b></td>
							
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

				</div>

			</div>

		</div>
		
		
		
		
	</div>
</div>
