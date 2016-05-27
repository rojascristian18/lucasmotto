
<? 
if (empty($productos)) { ?>
	<div class="col-md-12">
		<p class="bg-info">No se encontraron productos en esta categoría.</p>
	</div>
<? }
foreach ($productos as $item) { ?>

<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
	<div class="item-container">
		<div class="item-image">
			<span class="item-name"><? echo $item['Producto']['nombre'] ?></span>
			<? echo $this->Html->image( 'ImagenProducto/'. $item['ImagenProducto'][0]['id'] . '/item_' . $item['ImagenProducto'][0]['nombre'] , array( 'class' => 'responsive-img' ) ); ?>
			<span class="precio">
				<? echo $this->Number->currency($item['Producto']['valor'], '$ ', array('thousands' => '.', 'places' => '0')); ?>
			</span>
		</div>
		<div class="item-bottom">
			<div class="item-check">
				<input name='comparar' class='form-control check-comparar' value='<?= $item['Producto']['id'] ?>' onclick='agregarComparar( this );' type='checkbox'>
				 <label>Comparar</label>
			</div><!--
			--><div class="item-btn">
				<?=	$this->Html->link(
			           'Ver',
			           array('controller' => 'productos', 'action' => 'view', $item['Producto']['slug']),
			           array('escape' => false, 'class' => 'btn-ver link')
				); ?>
			</div>
		</div>
	</div>
</div>

 <? } ?>

