<?php
App::uses('AppController', 'Controller');
class ProveedoresController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$proveedores	= $this->paginate();
		$this->set(compact('proveedores'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Proveedor->create();
			if ( $this->Proveedor->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$regiones	= $this->Proveedor->Region->find('list');
		$productos	= $this->Proveedor->Producto->find('list');
		$this->set(compact('regiones', 'productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Proveedor->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Proveedor->save($this->request->data) )
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
			$this->request->data	= $this->Proveedor->find('first', array(
				'conditions'	=> array('Proveedor.id' => $id)
			));
		}
		$regiones	= $this->Proveedor->Region->find('list');
		$productos	= $this->Proveedor->Producto->find('list');
		$this->set(compact('regiones', 'productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Proveedor->id = $id;
		if ( ! $this->Proveedor->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Proveedor->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Proveedor->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Proveedor->_schema);
		$modelo			= $this->Proveedor->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
