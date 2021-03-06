<?php
App::uses('AppController', 'Controller');
class EstadoCivilesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$estadoCiviles	= $this->paginate();
		$this->set(compact('estadoCiviles'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->EstadoCivil->create();
			if ( $this->EstadoCivil->save($this->request->data) )
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
		if ( ! $this->EstadoCivil->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->EstadoCivil->save($this->request->data) )
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
			$this->request->data	= $this->EstadoCivil->find('first', array(
				'conditions'	=> array('EstadoCivil.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->EstadoCivil->id = $id;
		if ( ! $this->EstadoCivil->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->EstadoCivil->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->EstadoCivil->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->EstadoCivil->_schema);
		$modelo			= $this->EstadoCivil->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
