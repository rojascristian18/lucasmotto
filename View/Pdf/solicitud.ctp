<div class="container solicitud">
	<div class="col-12">
		<div class="logo text-center">
			<h2>LUCASMOTTO.CL</h2>
			<p>Financiamiento Veloz</p>
		</div>
	</div>
	<div class="col-12 text-center">
		<h3 class="titulo">Información Importante</h3>
	</div>
	<table style="width:65%;">
		<tr>
			<td><span class="campo">Moto*</span></td>
			<td><span class="campo"><?= $marca; ?></span></td>
			<td><span class="campo"><?= $modelo; ?></span></td>
		</tr>
		<tr>
			<td><span class="campo">Precio de referencia**</span></td>
			<td><span class="campo"><?= $producto[0]['valor']; ?></span></td>
			<td></td>
		</tr>
	</table>
	<div class="imagen">
		<?= $this->Html->image( 'ImagenProducto/'. $producto[0]['ImagenProducto'][0]['id'] . '/item_' . $producto[0]['ImagenProducto'][0]['nombre'] , array( 'class' => 'responsive-img' , 'fullBase' => true) ); ?>
	</div>
	<div class="text-center caja-cuotas">
		<p class="medium-text">Valor Cuota de Referencia</p><br>
		<p class="valor-cuota">$ ???????</p><br>
		<p class="medium-text">Mensuales a <?=$producto[0]['cuotas']; ?> meses</p>
	</div>
	<table style="margin-top: 170px; width:80%;">
		<tr>
			<td><span class="campo">Nombre Titular</span></td>
			<td><span class="campo"><?= $cliente['nombre']; ?></span></td>
		</tr>
		<tr>
			<td><span class="campo">Rut Titular</span></td>
			<td><span class="campo"><?= $cliente['rut']; ?></span></td>
		</tr>
	</table>
	<div class="contenido">
		<p>Para obtener una cotización y llevarte esta moto, por favor visita a cualquira de los siguientes distribuidores donde está disponible el crédito *** de Lucasmotto.cl</p>
		
	<table style="width:100%; margin: 20px 0; font-size:12px !important;">
		<? foreach ($producto[0]['Proveedor'] as $proveedor) { ?>
			<tr>
				<td><?= $proveedor['nombre']?></td>
				<td><?= $proveedor['sitio_web']?></td>
				<td><?= $proveedor['direccion']?></td>
			</tr>
		<? } ?>
	</table>

		<p><b>Cuando visites a un distribuidor, lleva contigo los siguientes documentos (en original, no se aceptan fotocopias) para acelerar el proceso de crédito:</b></p>
		<ol>
			<li>Las 3 últimas liquidacones de sueldo. si eres independiente, lleva una copia de un informe anual de boletas emitidas, el que puees obtener del sitio www.sii.cl</li>
			<li>Cuenta de agua, luz, gas o TV cable con tu dirección y a tu nombre</li>
			<li>Certificado de cotizaciones previsionales. Este lo puedes solicitar en tu AFP</li>
			<li>Certificado de antecedentes para fines particulares. Este se obtiene del Registro Civil: www.registrocivil.cl</li>
			<li>Fotocopia de tu cedula de identidad por ambos lados</li>
		</ol>
		<p style="margin-top:20px;">* Lucasmotto.cl no asegura la disponiblilidad de la moto seleccionada, circunstancia que dependerá del stock del distribuidor.</p>
		<p>** El precio indicado puede variar dependiendo del distribuidor quién puede establecer sus propios precios finales.</p>
		<p>*** <b>El crédito para la adquisición de esta moto considera el pago previo de un pié mínimo de 20%.</b></p>
	</div>
</div>