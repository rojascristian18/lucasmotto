<div id="buscar">
	<div class="container container-page">
		<? if (!empty($arregloProductos)) { ?>
			<div class="row">
			<div class="col-md-12">
				<h2 class="subtitle">Resultados</h2>
			</div>
			</div>
			<div class="row">
				<? 
					foreach ($arregloProductos as $item) {
						$item_col = "3";
						$this->set(compact('item' , 'item_col'));
					 	echo $this->element('item'); 
					}
				?>
			</div>
		<? } ?>
	</div>
</div>

