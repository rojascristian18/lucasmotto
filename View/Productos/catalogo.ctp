<!-- Catálogo -->
<div id="catalogo">
	<div class="container container-page">
		<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 pull-right">
					<div class="product-container">
						<? if (!empty($arregloProductos)) {
							
							foreach ($arregloProductos as $item) { 
									$item_col = "4";
									$this->set(compact('item' , 'item_col'));
									echo $this->element('/item');

								} ?>
						<?
						}else{

							if (empty($productos)) { ?>

							<div class="col-md-12">
								<p class="bg-info">No se encontraron motocicletas.</p>
							</div>

						<? }else{

								foreach ($productos as $item) { 
									$item_col = "4";
									$this->set(compact('item' , 'item_col'));
									echo $this->element('/item');

								} ?>
								
								

						<? } 
						} ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="sidebar-left">
						<?= $this->Form->create('Productos', array('action' => 'catalogo','class' => 'form')); ?>
						
						<h4>Categoría</h4>
						<? foreach ($tipoProductos as $tipoProducto) { ?>
							<div class="block">
								<label><?= $tipoProducto['TipoProducto']['nombre']; ?></label>
								<input type="checkbox" name='tipoproducto[]' value="<?= $tipoProducto['TipoProducto']['id']; ?>">
							</div>
						<? 
							} 
						?>

						<h4>Marca</h4>
						<? foreach ($marcas as $marca) { ?>
							<div class="block">
								<label><?= $marca['Marca']['nombre']; ?></label>
								<input type="checkbox" name='marca[]' value="<?= $marca['Marca']['id']; ?>">
							</div>
						<? 
							} 
						?>
						<h4>Precio</h4>
						<div class="block">
							<p><label for="amount"></label>
							  <input type="text" id="amount" readonly></p>
							  <input type="hidden" name="precio_min">
							  <input type="hidden" name="precio_max">
							 
							<div id="slider-range"></div>
						</div>
						<script type="text/javascript">

							$(function() {
							    $( "#slider-range" ).slider({
							      range: true,
							      min: 300000,
							      max: 2000000,
							      step: 50000,
							      values: [ 300000, 800000 ],
							      slide: function( event, ui ) {
							        $( "#amount" ).val( "$" + (ui.values[ 0 ]).formatMoney(0, ',', '.') + " - $" + (ui.values[ 1 ]).formatMoney(0, ',', '.') );
							      	$( "input[name='precio_min']" ).val(ui.values[ 0 ]);
							      	$( "input[name='precio_max']" ).val(ui.values[ 1 ]);
							      }
							    });
							    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
							      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
							  });

						</script>
						<div class="block no-border">
						<?	 
							foreach ($categorias as $categoria) {
								
								echo "<h4 class='no-border'>" .$categoria['Categoria']['nombre'] . "</h4>";
								echo "<select name='especificaciones[]' class='select'>";
								echo "<option value=''>Seleccione</option>";
								foreach ($categoria['Especificacion'] as $especificacion) {
									echo "<option value='" . $especificacion['id'] ."'>";
									echo $especificacion['nombre'];
									echo "</option>";
								}
								echo "</select>";
								
								
							}
						?>
						</div>
						<div class="block no-border">
							
							<button type="submit" class="btn btn-primary btn-filter" autocomplete="off" data-loading-text="Buscando..." >Filtrar</button>

							<?= $this->Form->end(); ?>

							<!-- Formulario para comparar -->
							<?= $this->Form->create('Productos', array('action' => 'comparar','class' => 'form')); ?>
							<button type="submit" class="btn btn-default btn-compare" autocomplete="off" data-loading-text="Comparando..." >Comparar</button>
							<?= $this->Form->end(); ?>
						</div>
						
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="pull-right">
						<ul class="pagination">
							<?= $this->Paginator->prev('Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'first disabled hidden')); ?>
							<?= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'modulus' => 2, 'currentClass' => 'active', 'separator' => '')); ?>
							<?= $this->Paginator->next('Siguiente', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'last disabled hidden')); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  