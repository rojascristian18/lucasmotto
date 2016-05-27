<?php
App::uses('AppController', 'Controller');
class EspecificacionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'contain'			=> 'Categoria'
		);
		$especificaciones	= $this->paginate();

		
		$this->set(compact('especificaciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Especificacion->create();
			if ( $this->Especificacion->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$categorias	= $this->Especificacion->Categoria->find('list', array( 'conditions' => array( 'parent_id !=' => 0 ) ) );
		$productos	= $this->Especificacion->Producto->find('list');
		$this->set(compact('categorias', 'productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Especificacion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Especificacion->save($this->request->data) )
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
			$this->request->data	= $this->Especificacion->find('first', array(
				'conditions'	=> array('Especificacion.id' => $id)
			));
		}
		$categorias	= $this->Especificacion->Categoria->find('list', array( 'conditions' => array( 'parent_id !=' => 0 ) ) );
		$productos	= $this->Especificacion->Producto->find('list');
		$this->set(compact('categorias', 'productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Especificacion->id = $id;
		if ( ! $this->Especificacion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Especificacion->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Especificacion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Especificacion->_schema);
		$modelo			= $this->Especificacion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
