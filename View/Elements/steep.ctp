		<div class="row">
			<div class="col-md-12 text-center">
				<h3 class="title">Pasos para obtener <br>tu moto</h3>
			</div>
		</div>
		<div class="row">
			<?
				$paso1 = "";
				$paso2 = "";
				$paso3 = "";
				$paso4 = "";

				foreach ($info as $paso) {
					$paso1 = $paso['contenido1'];
					$paso2 = $paso['contenido2'];
					$paso3 = $paso['contenido3'];
					$paso4 = $paso['contenido4'];
				}

				if ($paso1 != "") { ?>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<?= $this->Html->image('info/paso1.jpg' , array( 'class' => 'responsive-img' ) ); ?>
						<p><?= $paso1; ?></p>
					</div>
			<?	}
				
				if ($paso2 != "") { ?>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<?= $this->Html->image('info/paso2.jpg' , array( 'class' => 'responsive-img' ) ); ?>
						<p><?= $paso2; ?></p>
					</div>
			<?	}
				
				if ($paso3 != "") { ?>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<?= $this->Html->image('info/paso3.jpg' , array( 'class' => 'responsive-img' ) ); ?>
						<p><?= $paso3; ?></p>
					</div>
			<?	}

				if ($paso4 != "") { ?>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<?= $this->Html->image('info/paso4.jpg' , array( 'class' => 'responsive-img' ) ); ?>
						<p><?= $paso4; ?></p>
					</div>
			<?	} 	?>
		</div>