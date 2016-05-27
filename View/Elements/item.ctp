<!-- Item Style -->
<div class='col-lg-<?= $item_col; ?> col-md-<?= $item_col; ?> col-sm-<?= $item_col; ?> col-xs-12 item-comparar'>
	<div class='item-container'>
		<div class='item-image'>
			<span class='item-name'><?= $item['Producto']['nombre'] ?></span>
			<?= $this->Html->image( 'ImagenProducto/'. $item['ImagenProducto'][0]['id'] . '/item_' . $item['ImagenProducto'][0]['nombre'] , array( 'class' => 'responsive-img' ) ); ?>
			<span class='precio'>
				<?= $this->Number->currency($item['Producto']['valor'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
			</span>
		</div>
		<div class='item-bottom'>
			<div class='item-check'>
				<input name='comparar' class='form-control check-comparar' value='<?= $item['Producto']['id'] ?>' onclick='agregarComparar( this );' type='checkbox'>
				 <label>Comparar</label>
			</div><!--
			--><div class='item-btn'>
				<?=	$this->Html->link(
			           'Ver',
			           array('controller' => 'productos', 'action' => 'view', $item['Producto']['slug']),
			           array('escape' => false, 'class' => 'btn-ver link')
				); ?>

			</div>
		</div>
	</div>
</div>



