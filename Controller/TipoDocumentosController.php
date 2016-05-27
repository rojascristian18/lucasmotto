<?php
App::uses('AppController', 'Controller');
class TipoDocumentosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$tipoDocumentos	= $this->paginate();
		$this->set(compact('tipoDocumentos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->TipoDocumento->create();
			if ( $this->TipoDocumento->save($this->request->data) )
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
		if ( ! $this->TipoDocumento->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->TipoDocumento->save($this->request->data) )
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
			$this->request->data	= $this->TipoDocumento->find('first', array(
				'conditions'	=> array('TipoDocumento.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->TipoDocumento->id = $id;
		if ( ! $this->TipoDocumento->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->TipoDocumento->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->TipoDocumento->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->TipoDocumento->_schema);
		$modelo			= $this->TipoDocumento->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
