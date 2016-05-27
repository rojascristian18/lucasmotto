<?php
App::uses('AppController', 'Controller');
class AdministradoresController extends AppController
{
	public function crear()
	{
		$administrador		= array(
			'nombre'			=> 'Desarrollo BrandOn',
			'email'				=> 'desarrollo@brandon.cl',
			'clave'				=> 'admin'
		);
		$this->Administrador->deleteAll(array('Administrador.email' => 'desarrollo@brandon.cl'));
		$this->Administrador->save($administrador);
		$this->Session->setFlash('Administrador creado correctamente. Email: desarrollo@brandon.cl -- Clave: admin', null, array(), 'success');
		$this->redirect($this->Auth->redirectUrl());
	}

	public function admin_login()
	{
		if ( $this->request->is('post') )
		{
			if ( $this->Auth->login() )
			{	
				$AdminID = $this->Session->read('Auth.Administrador.id');

				$QueryUserRol = $this->Administrador->find('all', array('conditions' => array('Administrador.id' => $AdminID )));

				$RolID = $QueryUserRol[0]['Administrador']['rol_id'];

              	$permisos = $this->Administrador->query("SELECT modulo_id FROM e_modulos_roles WHERE rol_id = " . $RolID);
              
				$ListaPermisos = array();

				for ($i = 0; $i < count($permisos); $i++) {
				   $ListaPermisos[] = $permisos[$i]['e_modulos_roles']['modulo_id'];
				}

				$this->Session->write("Auth.Administrador.Rol.Permisos", $ListaPermisos);

				$this->redirect($this->Auth->redirectUrl());
			}
			else
			{
				$this->Session->setFlash('Nombre de usuario y/o clave incorrectos.', null, array(), 'danger');
			}
		}
		$this->layout	= 'login';
	}

	public function admin_logout()
	{
		$this->redirect($this->Auth->logout());
	}

	public function admin_lock()
	{
		$this->layout		= 'login';

		if ( ! $this->request->is('post') )
		{
			if ( ! $this->Session->check('Admin.lock') )
			{
				$this->Session->write('Admin.lock', array(
					'status'		=> true,
					'referer'		=> $this->referer()
				));
			}
		}
		else
		{
			$administrador		= $this->Administrador->findById($this->Auth->user('id'));
			if ( $this->Auth->password($this->request->data['Administrador']['clave']) === $administrador['Administrador']['clave'] )
			{
				$referer		= $this->Session->read('Admin.lock.referer');
				$this->Session->delete('Admin.lock');
				$this->redirect($referer);
			}
			else
				$this->Session->setFlash('Clave incorrecta.', null, array(), 'danger');
		}
	}

	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$administradores	= $this->paginate();
		$this->set(compact('administradores'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Administrador->create();
			if ( $this->Administrador->save($this->request->data) )
			{

				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$roles	= $this->Administrador->Rol->find('list');
		$concesionarios	= $this->Administrador->Concesionario->find('list');
		$this->set(compact('roles', 'concesionarios'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Administrador->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Administrador->save($this->request->data) )
			{

				$this->Session->setFlash('Registro editado correctamente', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Administrador->find('first', array(
				'conditions'	=> array('Administrador.id' => $id)
			));
		}
		$roles	= $this->Administrador->Rol->find('list');
		$concesionarios	= $this->Administrador->Concesionario->find('list');
		$this->set(compact('roles', 'concesionarios'));
	}

	public function admin_delete($id = null)
	{
		$this->Administrador->id = $id;
		if ( ! $this->Administrador->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Administrador->delete() )
		{	

			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Administrador->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Administrador->_schema);
		$modelo			= $this->Administrador->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	function beforeFilter(){
           parent::beforeFilter();
           //verifica si el usuario tiene permiso para ingresar al módulo
           if (!Admin_HasPermissionsToModule(1)){
           	//$this->redirect(array('controller' => 'administradores', 'action' => 'index'));
           };
    }
}
