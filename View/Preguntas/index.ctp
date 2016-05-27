<div id="preguntasFrecuentes">
	<div class="container container-page">
		<div class="row">
			<div class="col-md-12">
				<h3 class="subtitle">
					Preguntas Frecuentes
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?
				$contador = 1;
				foreach ($preguntas as $pregunta) { ?>
					<? if ($contador == 1) {
						$active = 'in';
					}else{
						$active = "";
					} ?>
					<div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading<?= $pregunta['Pregunta']['id']; ?>">
					      <h4 class="panel-title">
					        <a role="button" class="link" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $pregunta['Pregunta']['id']; ?>" aria-expanded="true" aria-controls="collapse<?= $pregunta['Pregunta']['id']; ?>">
					        <span class='item'><?= $contador ?>) </span>
 							<?= $pregunta['Pregunta']['pregunta']; ?>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse<?= $pregunta['Pregunta']['id']; ?>" class="panel-collapse collapse <?= $active; ?>" role="tabpanel" aria-labelledby="heading<?= $pregunta['Pregunta']['id']; ?>">
					      <div class="panel-body">
					       <?= $pregunta['Pregunta']['respuesta']; ?>
					      </div>
					    </div>
					</div>
				<? 
				$contador++;
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>