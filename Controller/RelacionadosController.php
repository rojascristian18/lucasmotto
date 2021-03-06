<?php
App::uses('AppController', 'Controller');
class RelacionadosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$relacionados	= $this->paginate();
		$this->set(compact('relacionados'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Relacionado->create();
			if ( $this->Relacionado->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Relacionado->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Relacionado->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Relacionado->save($this->request->data) )
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
			$this->request->data	= $this->Relacionado->find('first', array(
				'conditions'	=> array('Relacionado.id' => $id)
			));
		}
		$productos	= $this->Relacionado->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Relacionado->id = $id;
		if ( ! $this->Relacionado->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Relacionado->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Relacionado->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Relacionado->_schema);
		$modelo			= $this->Relacionado->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
