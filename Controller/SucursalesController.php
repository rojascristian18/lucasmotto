<?php
App::uses('AppController', 'Controller');
class SucursalesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$sucursales	= $this->paginate();
		$this->set(compact('sucursales'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Sucursal->create();
			if ( $this->Sucursal->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$concesionarios	= $this->Sucursal->Concesionario->find('list');
		$comunas	= $this->Sucursal->Comuna->find('list');
		$productos	= $this->Sucursal->Producto->find('list');
		$this->set(compact('concesionarios', 'comunas', 'productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Sucursal->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Sucursal->save($this->request->data) )
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
			$this->request->data	= $this->Sucursal->find('first', array(
				'conditions'	=> array('Sucursal.id' => $id)
			));
		}
		$concesionarios	= $this->Sucursal->Concesionario->find('list');
		$comunas	= $this->Sucursal->Comuna->find('list');
		$productos	= $this->Sucursal->Producto->find('list');
		$this->set(compact('concesionarios', 'comunas', 'productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Sucursal->id = $id;
		if ( ! $this->Sucursal->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Sucursal->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Sucursal->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Sucursal->_schema);
		$modelo			= $this->Sucursal->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
