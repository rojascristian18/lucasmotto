<?php
App::uses('AppController', 'Controller');
class CategoriaproductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$categoriaproductos	= $this->paginate();
		$this->set(compact('categoriaproductos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Categoriaproducto->create();
			if ( $this->Categoriaproducto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Categoriaproducto->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Categoriaproducto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Categoriaproducto->save($this->request->data) )
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
			$this->request->data	= $this->Categoriaproducto->find('first', array(
				'conditions'	=> array('Categoriaproducto.id' => $id)
			));
		}
		$productos	= $this->Categoriaproducto->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Categoriaproducto->id = $id;
		if ( ! $this->Categoriaproducto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Categoriaproducto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Categoriaproducto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Categoriaproducto->_schema);
		$modelo			= $this->Categoriaproducto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
