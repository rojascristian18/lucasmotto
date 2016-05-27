<?php
App::uses('AppController', 'Controller');
class CategoriasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0,
			'conditions'		=> array('parent_id' => 0)
		);

		$categorias	= $this->paginate();
		$this->set(compact('categorias'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Categoria->create();
			if ( $this->Categoria->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$categorias	= $this->Categoria->find('list' , array('conditions' => array('parent_id' => 0) ) );
		$this->set(compact('categorias'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Categoria->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			if ( $this->Categoria->save($this->request->data) )
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
			$this->request->data	= $this->Categoria->find('first', array(
				'conditions'	=> array('Categoria.id' => $id)
			));
		}
		$categorias	= $this->Categoria->find('list' , array('conditions' => array('parent_id' => 0) ) );
		$this->set(compact('categorias'));
	}

	public function admin_delete($id = null)
	{
		$this->Categoria->id = $id;
		if ( ! $this->Categoria->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Categoria->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Categoria->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Categoria->_schema);
		$modelo			= $this->Categoria->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	/**

		Obtiene las categorías y sus especificaciones asociadas

	*/
	public function admin_getCategory(){

	return $this->Categoria->find( 'all', array('conditions' => array('parent_id !=' => 0), 'contain' => 'Especificacion') );

	}
}
