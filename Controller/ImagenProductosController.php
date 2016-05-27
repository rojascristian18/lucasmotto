<?php
App::uses('AppController', 'Controller');
class ImagenProductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$imagenProductos	= $this->paginate();
		$this->set(compact('imagenProductos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->ImagenProducto->create();
			if ( $this->ImagenProducto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->ImagenProducto->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->ImagenProducto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->ImagenProducto->save($this->request->data) )
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
			$this->request->data	= $this->ImagenProducto->find('first', array(
				'conditions'	=> array('ImagenProducto.id' => $id)
			));
		}
		$productos	= $this->ImagenProducto->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->ImagenProducto->id = $id;
		if ( ! $this->ImagenProducto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->ImagenProducto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->ImagenProducto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->ImagenProducto->_schema);
		$modelo			= $this->ImagenProducto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
