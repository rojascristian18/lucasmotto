<?php
App::uses('AppController', 'Controller');
class PreguntasController extends AppController
{
	
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$preguntas	= $this->paginate();
		$this->set(compact('preguntas'));
	}



	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Pregunta->create();
			if ( $this->Pregunta->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
	}



	public function admin_edit($id = null)
	{
		if ( ! $this->Pregunta->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Pregunta->save($this->request->data) )
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
			$this->request->data	= $this->Pregunta->find('first', array(
				'conditions'	=> array('Pregunta.id' => $id)
			));
		}
	}



	public function admin_delete($id = null)
	{
		$this->Pregunta->id = $id;
		if ( ! $this->Pregunta->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Pregunta->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}



	public function admin_exportar()
	{
		$datos			= $this->Pregunta->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Pregunta->_schema);
		$modelo			= $this->Pregunta->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}



	public function index(){

		$preguntas = $this->Pregunta->find('all', array('order' => array('orden DESC')));
		
		$this->set(compact('preguntas'));
	}
}
	