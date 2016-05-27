<div class="container container-page">
	<div class="row">
			
		<div class="col-lg-12 text-center">
			<h3 class="title">Marcas Asociadas</h3>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-1 col-sm-1 col-xs-1 text-center pad">
			<i class="fa fa-chevron-left" id="btn-toLeft" onclick='moveLeft();'></i>
		</div>
		<div class="col-md-10 col-sm-10 col-xs-10">
			<div class="brand-container">
				<ul class="unlist">
				<?
				foreach ($marcas as $marca) {
					echo "<li class='gallery-brand'>" . $this->Html->image($marca['Marca']['imagen_marca']['mini'] , array('class' => 'responsive-img'));
					echo "</li>";
				}?>
				</ul>
			</div>
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1 text-center pad">
			<i class="fa fa-chevron-right" id="btn-toRight" onclick='moveRight();'></i>
		</div>
	</div>
</div>