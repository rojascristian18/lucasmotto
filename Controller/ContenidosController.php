<?php
App::uses('AppController', 'Controller');
class ContenidosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$contenidos	= $this->paginate();
		$this->set(compact('contenidos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{	
			$this->Contenido->create();
			if ( $this->Contenido->saveAll($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$paginas = $this->Contenido->Pagina->find('list');
		$this->set(compact('paginas'));

	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Contenido->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			if ( $this->Contenido->saveAll($this->request->data) )
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
			$this->request->data	= $this->Contenido->find('first', array(
				'conditions'	=> array('Contenido.id' => $id)
			));
		}
		$paginas = $this->Contenido->Pagina->find('list');
		$this->set(compact('paginas'));
	}

	public function admin_delete($id = null)
	{
		$this->Contenido->id = $id;
		if ( ! $this->Contenido->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Contenido->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Contenido->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Contenido->_schema);
		$modelo			= $this->Contenido->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
