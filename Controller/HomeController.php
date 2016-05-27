<?php
App::uses('AppController', 'Controller');
class HomeController extends AppController
{
	public function admin_index()
	{
		$user = $this->Auth->user('nombre');

		$this->set(compact('user'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Cliente->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Cliente->_schema);
		$modelo			= $this->Cliente->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	/************************
		Public
	*/

	public function index()
	{
		
	}
}
