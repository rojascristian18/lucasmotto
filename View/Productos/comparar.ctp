<div id="comparar">
	<div class="container container-page">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="visible-xs">
					<label class="name">Nombre</label>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<?	
					$columnas = count($productos);
					$productosAComparar = array();
					$productosEspecificacion = array();
					$contador = 0;

					foreach ($productos as $item) : 
						$item_col = 12/$columnas . " " . "comparar-small col-xs-" . 12/$columnas ;
						$this->set(compact('item' , 'item_col'));
						echo $this->element('/item');
						$posiciones[]['id'] = $item['Producto']['id'];
					endforeach;
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?foreach ($categoriaPadres as $categoriaPadre) : ?>
			    		<div class="panel panel-default">
			    			<div class="panel-heading" role="tab" id="headPanel<?= $categoriaPadre['Categoria']['nombre']; ?>">
				    			<h4 class="panel-title">
							        <a role="button" class="link title-detail" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $categoriaPadre['Categoria']['nombre']; ?>" aria-expanded="true" aria-controls="collapse<?= $categoriaPadre['Categoria']['nombre']; ?>">
							          <?= $categoriaPadre['Categoria']['nombre']; ?>
							        </a>
						      	</h4>
					    	</div><!-- end div.panel-heading -->

					    	<div id="collapse<?= $categoriaPadre['Categoria']['nombre']; ?>" class="panel-collapse collapse <? if($contador == 0) echo "in"; ?>" role="tabpanel" aria-labelledby="headPanel<?= $categoriaPadre['Categoria']['nombre']; ?>">
						      	<div class="panel-body">
						      		<?foreach ($categoriaPadre['children'] as $categoria) : ?>
							    		<div class="row">
											<div class="col-md-4 col-sm-4 col-xs-4">
												<label><?= $categoria['Categoria']['nombre']; ?></label>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-8">
												<?foreach ($posiciones as $llave => $valor) : ?>
													<div class="col-md-<?= 12/$columnas; ?> col-sm-<?= 12/$columnas; ?> col-xs-<?= 12/$columnas; ?> text-center border">
														<?foreach ($categoria['Especificacion'] as $key => $especificacion):
															foreach ($especificacion['Producto'] as $llave => $producto):
																if ($producto['id'] == $valor['id']) {
																	echo "<label>" . $especificacion['nombre'] . "</label>" ;
																}
															endforeach;
														endforeach; ?>
													</div>
												<?endforeach; ?>  
											</div>
										</div>
							    	<?endforeach; ?>
						    	</div><!-- end div.panel-body -->
							</div><!-- end div.collapse -->
						</div><!-- end div.panel-default -->
					<? $contador++;	
					endforeach; ?>
				</div><!-- end div.panel-group -->
			</div><!-- end div.col -->
		</div><!-- end div.row -->
	</div><!-- end div.container -->
</div><!-- end div#comprar -->