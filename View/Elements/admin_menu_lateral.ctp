<div class="page-sidebar">
	<ul class="x-navigation x-navigation-custom">
				<li class="xn-logo">
					<?= $this->Html->link(
						'<span class="fa fa-dashboard"></span> <span class="x-navigation-control">Backend</span>',
						'/admin',
						array('escape' => false)
					); ?>
				</li>
				<a href="#" class="x-navigation-control"></a>

				<li class="xn-title"></li>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'home', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-home"></span> <span class="xn-text">Home</span>',
						array('controller' => 'home', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>

		<!-- Get Modules View -->	
		<?= $this->element('modulos'); ?>


		<!--<?	if (Admin_HasPermissionsToModule(8) || Admin_HasPermissionsToModule(6) || Admin_HasPermissionsToModule(7)){ ?>
				<li class="xn-title">Panel de Control</li>
		<? 	}	?>
					

					<? if (Admin_HasPermissionsToModule(8)){ ?>
					<li class="<?= ($this->Html->menuActivo(array('controller' => 'clientes', 'action' => 'index')) ? 'active' : ''); ?>">
						<?= $this->Html->link(
							'<span class="fa fa-users"></span> <span class="xn-text">Clientes</span>',
							array('controller' => 'clientes', 'action' => 'index'),
							array('escape' => false)
						); ?>
					</li>
					<? } ?>

					<? if(Admin_HasPermissionsToModule(7)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'modulos', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-list"></span> <span class="xn-text">Módulos</span>',
								array('controller' => 'modulos', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>

					<? if(Admin_HasPermissionsToModule(6)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'roles', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-sitemap"></span> <span class="xn-text">Roles</span>',
								array('controller' => 'roles', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(19)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'slides', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-sliders"></span> <span class="xn-text">Slides</span>',
								array('controller' => 'slides', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(12)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'imagenes', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-picture-o"></span> <span class="xn-text">Imágenes</span>',
								array('controller' => 'imagenes', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(20)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'sliderposiciones', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-paper-plane "></span> <span class="xn-text">Ubicaciones</span>',
								array('controller' => 'sliderposiciones', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(21)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'configuraciones', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-cogs"></span> <span class="xn-text">Configuración del sitio</span>',
								array('controller' => 'configuraciones', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(22)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'contenidos', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-file"></span> <span class="xn-text">Contenido Páginas</span>',
								array('controller' => 'contenidos', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>
					<? if(Admin_HasPermissionsToModule(24)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'preguntas', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-question"></span> <span class="xn-text">Preguntas Frecuentes</span>',
								array('controller' => 'preguntas', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>

		<?	if (Admin_HasPermissionsToModule(3)){ ?>
				<li class="xn-title">Usuarios</li>

				<li class="<?= ($this->Html->menuActivo(array('controller' => 'administradores', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-user"></span> <span class="xn-text">Usuarios</span>',
						array('controller' => 'administradores', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
		<? 	} 	?>
		<? if(Admin_HasPermissionsToModule(23)){ ?>	
						<li class="<?= ($this->Html->menuActivo(array('controller' => 'logs', 'action' => 'index')) ? 'active' : ''); ?>">
							<?= $this->Html->link(
								'<span class="fa fa-list-ol"></span> <span class="xn-text">Logs</span>',
								array('controller' => 'logs', 'action' => 'index'),
								array('escape' => false)
							); ?>
						</li>
					<? } ?>

		<? 	if (Admin_HasPermissionsToModule(5)){ ?>
				<li class="xn-title">Proveedores</li>

				<li class="<?= ($this->Html->menuActivo(array('controller' => 'proveedores', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-truck"></span> <span class="xn-text">Prooverdores</span>',
						array('controller' => 'proveedores', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
		<? 	} 	?>

		<?	if (Admin_HasPermissionsToModule(16)){ ?>
				<li class="xn-title">Modelos</li>

				<li class="<?= ($this->Html->menuActivo(array('controller' => 'marcas', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-shopping-bag"></span> <span class="xn-text">Marcas</span>',
						array('controller' => 'marcas', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>

				<li class="<?= ($this->Html->menuActivo(array('controller' => 'modelos', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-shopping-bag"></span> <span class="xn-text">Modelos</span>',
						array('controller' => 'modelos', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
		<? } ?>

		

		<?	if (Admin_HasPermissionsToModule(14) || Admin_HasPermissionsToModule(13)){ ?>
				<li class="xn-title">Configuración</li>

				<?	if (Admin_HasPermissionsToModule(14)){ ?>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'categorias', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-cubes"></span> <span class="xn-text">Tipo de especificación</span>',
						array('controller' => 'categorias', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<? } ?>

				<?	if (Admin_HasPermissionsToModule(13)){ ?>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'especificaciones', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-puzzle-piece"></span> <span class="xn-text">Especificación</span>',
						array('controller' => 'especificaciones', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<? } ?>
		<? 	}	?>

		<?	if (Admin_HasPermissionsToModule(11)){ ?>
				<li class="xn-title">Motos</li>

				<?	if (Admin_HasPermissionsToModule(11)){ ?>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'productos', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-motorcycle"></span> <span class="xn-text">Motos</span>',
						array('controller' => 'productos', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'tipoproductos', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-cog"></span> <span class="xn-text">Categoría motos</span>',
						array('controller' => 'tipoproductos', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<? } ?>

				<?	if (Admin_HasPermissionsToModule(12)){ ?>
				
				<? } ?>
		<? 	}	?>

		<?	if (Admin_HasPermissionsToModule(15)){ ?>
				<li class="xn-title">Solicitudes</li>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'transacciones', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-exchange"></span> <span class="xn-text">Solicitudes</span>',
						array('controller' => 'transacciones', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
				<li class="<?= ($this->Html->menuActivo(array('controller' => 'documentos', 'action' => 'index')) ? 'active' : ''); ?>">
					<?= $this->Html->link(
						'<span class="fa fa-file-text-o"></span> <span class="xn-text">Documentos</span>',
						array('controller' => 'documentos', 'action' => 'index'),
						array('escape' => false)
					); ?>
				</li>
		<? } ?>

		<? if(Admin_HasPermissionsToModule(10)){ ?>	
					
			<li class="xn-title">Super Usuarios</li>

			<? 	$controladores		=  array_map(function($controlador) {

					return str_replace('Controller', '', $controlador);

				}, App::objects('controller')); ?>

			<li class="xn-openable">
				<a href="#"><span class="fa fa-cog"></span> <span class="xn-text">Controladores</span></a>
				<ul>
					<? foreach ( $controladores as $controlador ) : ?>
					<? if ( $controlador === 'App' ) continue; ?>
					<li class="<?= ($this->Html->menuActivo(array('controller' => strtolower($controlador))) ? 'active' : ''); ?>">
						<?= $this->Html->link(
							sprintf('<span class="fa fa-list"></span> <span class="xn-text">%s</span>', ucfirst($controlador)),
							array('controller' => strtolower($controlador), 'action' => 'index'),
							array('escape' => false)
						); ?>
					</li>
					<? endforeach; ?>
				</ul>
			</li>			
		<? } //End Super User ?>
		
		-->
	</ul>
</div>
