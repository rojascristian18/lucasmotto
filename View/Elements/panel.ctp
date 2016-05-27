<? 
	$tabHTML 	= "";
	$imagenHTML	= "";
	$contador 	= 0;

	foreach ($tipoProductos as $tipoProducto) {

		if ($contador == 0) {
			$imagenHTML .= "<div role='tabpanel' class='tab-pane active' id='" . $tipoProducto['TipoProducto']['slug'] . "'>";
		}else{
			$imagenHTML .= "<div role='tabpanel' class='tab-pane' id='" . $tipoProducto['TipoProducto']['slug'] . "'>";
		}
			$imagenHTML .= $this->Html->image( $tipoProducto['TipoProducto']['ruta']['banner'], array( 
												'class' => 'responsive-img' ) 
										);
			$imagenHTML .= "</div>";

		if ($contador == 0) {
			$tabHTML	.= "<li role='presentation' class='active' data-cat='" . $tipoProducto['TipoProducto']['id'] ."'>";
		}else{
			$tabHTML	.= "<li role='presentation'>";
		}
			
			$tabHTML 	.= "<a href='#" . $tipoProducto['TipoProducto']['slug'];
			$tabHTML 	.= "' aria-controls='home' role='tab' data-toggle='tab'"; 
			$tabHTML 	.= "onclick='getProducto(" . $tipoProducto['TipoProducto']['id'] . ")' >";
			$tabHTML 	.= $tipoProducto['TipoProducto']['nombre'] .  "</a></li>";

		$contador++;
	}
?>

<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
			<?= $imagenHTML; ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="content">
		  <ul class="nav nav-tabs" role="tablist">
			
			<?= $tabHTML; ?>	    

		  </ul>
		</div>
	</div>
</div>
<div class="row">
	
	<div class="panel-productos">
		    
	</div>

</div>