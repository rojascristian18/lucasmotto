	<table style="width:600px; max-width:100%;">
		<tr>
			<td colspan="2" style="background-color:#253C6B;padding:10px;text-align:centr"><h3 style="color:#fff;">Nuevo contacto</h3></td>
		</tr>
		<tr>
			<td style="padding:10px;"><b>Nombre y apellido</b></td>
			<td style="padding:10px;"><?= $data['Pagina']['nombre'] . " " . $data['Pagina']['apellido']; ?></td>
		</tr>
		<tr>
			<td style="padding:10px;"><b>Email</b></td>
			<td style="padding:10px;"><?= $data['Pagina']['email']; ?></td>
		</tr>
		<tr>
			<td style="padding:10px;"><b>Fono</b></td>
			<td style="padding:10px;"><?= $data['Pagina']['fono']; ?></td>
		</tr>
		<tr>
			<td style="padding:10px;"><b>Mensaje</b></td>
			<td style="padding:10px;"><?= $data['Pagina']['mensaje']; ?></td>
		</tr>
	</table>