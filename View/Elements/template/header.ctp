<div id="header">
	<div class="container container-page">
	
		<div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<a href="<?=$this->Html->url('/', true); ?>"> 
				<?= $this->Html->image($logoHome['Imagen']['ruta']['path'] , array('class' => 'logo')); ?>
				</a>
			</div>

			<div class="col-lg-6 col-lg-offet-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-6">

				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					    </div>
				    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="table-menu hidden-xs">

							<ul class="nav navbar-nav">
								<li><?=	$this->Html->link(
								           'Catálogo',
								           array('controller' => 'productos', 'action' => 'catalogo'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Quiénes somos',
								           array('controller' => 'paginas', 'action' => 'quienes_somos'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Preguntas frecuentes',
								           array('controller' => 'preguntas-frecuentes', 'action' => 'index'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Contacto',
								           array('controller' => 'paginas', 'action' => 'contacto'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
							</ul>
					    </div><!-- /.navbar-collapse -->
				</nav>

			</div>

			<div class="col-xs-12 visible-xs">
				
				 <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="menu">
							
							<!-- Search box for mobile device -->
							<div class="visible-xs">

									<?= $this->Form->create('productos', array('action' => 'catalogo','class' => '')); ?>
											<span class="search-box">
												<input name="search" class="search-input" value="" type="text" >
												<button class="search-button"><i class="fa fa-search"></i></button>
											</span>
									<?= $this->Form->end(); ?>

							</div>

							<ul class="nav navbar-nav">
								<li><?=	$this->Html->link(
								           'Catálogo',
								           array('controller' => 'productos', 'action' => 'catalogo'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Quiénes somos',
								           array('controller' => 'paginas', 'action' => 'quienes_somos'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Preguntas frecuentes',
								           array('controller' => 'preguntas', 'action' => 'index'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
								<li><?=	$this->Html->link(
								           'Contacto',
								           array('controller' => 'paginas', 'action' => 'contacto'),
								           array('escape' => false, 'class' => 'link')
								       ); ?>
								</li>
							</ul>
					    </div><!-- /.navbar-collapse -->
	
			</div>

			<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs text-right">
				<!-- Search box for desktop device -->
				<?= $this->Form->create('productos', array('action' => 'catalogo','class' => '')); ?>
						<span class="search-box">
							<input name="search" class="search-input" value="" type="text" >
							<button class="search-button"><i class="fa fa-search"></i></button>
						</span>
				<?= $this->Form->end(); ?>

			</div>

		</div>

	</div>
</div>
<div id="comparador">
	<div class="form-container">
	<!-- Formulario para comparar -->
		<?= $this->Form->create('Productos', array('action' => 'comparar','class' => 'form')); ?>
		<button type="submit" class="btn btn-default btn-compare" autocomplete="off" data-loading-text="Comparando..." >Comparar</button>
		<?= $this->Form->end(); ?>
	</div>
</div>
<div class="container container-page">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?= $this->element('admin_alertas'); ?>
		</div>
	</div>
</div>