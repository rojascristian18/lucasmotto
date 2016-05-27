<?php
App::uses('AppController', 'Controller');
class TipoClientesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$tipoClientes	= $this->paginate();
		$this->set(compact('tipoClientes'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->TipoCliente->create();
			if ( $this->TipoCliente->save($this->request->data) )
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
		if ( ! $this->TipoCliente->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->TipoCliente->save($this->request->data) )
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
			$this->request->data	= $this->TipoCliente->find('first', array(
				'conditions'	=> array('TipoCliente.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->TipoCliente->id = $id;
		if ( ! $this->TipoCliente->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->TipoCliente->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->TipoCliente->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->TipoCliente->_schema);
		$modelo			= $this->TipoCliente->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
