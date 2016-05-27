<? $contador = 0;?>
<div class='ficha-tecnica'>
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
								<div class="col-md-4 col-xs-4">
									<label><?= $categoria['Categoria']['nombre']; ?></label>
								</div>
								<div class="col-md-8 col-xs-8 text-center">
									<?foreach ($categoria['Especificacion'] as $key => $especificacion): 
										if ($producto['Producto']['id'] == isset($especificacion['Producto'][$key]['id'])) {
											echo "<label>" . $especificacion['nombre'] . "</label>";
										}
									endforeach; ?>
								</div> 
							</div>
				    	<?endforeach; ?>
				    </div><!-- end div.panel-body -->
			    </div><!-- end div.panel-collapse -->
			</div><!-- end div.panel-default -->
		<? $contador++;	endforeach; ?>
	</div><!-- end div.panel-group -->
</div><!-- end div.ficha-tecnica -->