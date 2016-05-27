<? if (!empty($productosRelacionados)) { ?>

	<div class="col-md-12">
		<h3 class="subtitle">Motos similares</h3>
	</div>

	<?foreach ($productosRelacionados as $index => $item) { ?>
	<!-- Item Style -->
	<div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 item-comparar'>
		<div class='item-container'>
			<div class='item-image'>
				<span class='item-name'><?= $item[0]['Producto']['nombre'] ?></span>
				<?= $this->Html->image( 'ImagenProducto/'. $item[0]['ImagenProducto'][0]['id'] . '/item_' . $item[0]['ImagenProducto'][0]['nombre'] , array( 'class' => 'responsive-img' ) ); ?>
				<span class='precio'>
					<?= $this->Number->currency($item[0]['Producto']['valor'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
				</span>
			</div>
			<div class='item-bottom'>
				<div class='item-check'>
					<input name='comparar' class='form-control check-comparar' value='<?= $item[0]['Producto']['id'] ?>' onclick='agregarComparar( this );' type='checkbox'>
					 <label>Comparar</label>
				</div><!--
				--><div class='item-btn'>
					<?=	$this->Html->link(
				           'Ver',
				           array('controller' => 'productos', 'action' => 'view', $item[0]['Producto']['slug']),
				           array('escape' => false, 'class' => 'btn-ver link')
					); ?>

				</div>
			</div>
		</div>
	</div>
<? } 
}
