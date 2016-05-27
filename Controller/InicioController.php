<?php
App::uses('AppController', 'Controller');
class InicioController extends AppController
{

	/************************
		Public
	*/

	public function index(){

		$slideres = $this->requestAction(array('controller' => 'Slideres', 'action' => 'getSlideresByPosition', 1));

		$items = $this->requestAction(array('controller' => 'Productos', 'action' => 'getFeaturedHome'));

		$tipoProductos = $this->requestAction(array('controller' => 'Productos', 'action' => 'getCategoryProduct'));

		$marcas	= $this->requestAction(array('controller' => 'Marcas', 'action' => 'getBrands'));
		
		$this->set(compact('slideres', 'items' , 'tipoProductos' , 'marcas' ));
		
	}
}
