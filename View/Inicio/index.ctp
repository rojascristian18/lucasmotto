<!-- Slider -->
<?= $this->element('/homeslider'); ?>

<!-- Destacados -->
<div id="seccion-destacados">
	<div class="container container-page">
		<div class="row">

			<div class="col-md-12 text-center">
				
				<h3 class="title">Destacados</h3>

			</div>
		</div>
		<div class="row">
		<? foreach ( $items as $key => $item ) {
			$item_col = "3";
			$this->set(compact('item' , 'item_col'));
		 	echo $this->element('item'); 
		 } ?>
		 </div>
	</div>
</div>

<!-- Categorias -->
<div id="seccion-categoria">
	<div class="container container-page">
		<?= $this->element('/panel'); ?>
	</div>
</div>

<div class="blue-line"></div>

<!-- Pasos -->
<div id="pasos">
	<div class="container container-page">
		<?= $this->element('/steep'); ?>
	</div>
</div>

<!-- Marcas -->
<div id="marcas">
	<?= $this->element('/brand'); ?>
</div>