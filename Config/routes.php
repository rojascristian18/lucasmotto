<?php
//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

Router::connect('/', array('controller' => 'inicio', 'action' => 'index'));

Router::connect('/admin', array('controller' => 'home', 'action' => 'index', 'admin' => true));
Router::connect('/admin/login', array('controller' => 'administradores', 'action' => 'login', 'admin' => true));

Router::connect('/seccion/*', array('controller' => 'pages', 'action' => 'display'));

Router::connect('/producto/*', array('controller' => 'productos', 'action' => 'view'));

Router::connect('/preguntas-frecuentes', array('controller' => 'preguntas', 'action' => 'index'));

Router::connect('/quienes-somos', array('controller' => 'paginas', 'action' => 'quienes_somos'));

Router::connect('/contacto', array('controller' => 'paginas', 'action' => 'contacto'));

Router::connect('/solicitud', array('controller' => 'transacciones', 'action' => 'solicitud'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
