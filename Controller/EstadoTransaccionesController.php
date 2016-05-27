<?php
App::uses('AppController', 'Controller');
class EstadoTransaccionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$estadoTransacciones	= $this->paginate();
		$this->set(compact('estadoTransacciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->EstadoTransaccion->create();
			if ( $this->EstadoTransaccion->save($this->request->data) )
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
		if ( ! $this->EstadoTransaccion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->EstadoTransaccion->save($this->request->data) )
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
			$this->request->data	= $this->EstadoTransaccion->find('first', array(
				'conditions'	=> array('EstadoTransaccion.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->EstadoTransaccion->id = $id;
		if ( ! $this->EstadoTransaccion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->EstadoTransaccion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->EstadoTransaccion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->EstadoTransaccion->_schema);
		$modelo			= $this->EstadoTransaccion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
