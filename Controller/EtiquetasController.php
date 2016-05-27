<?php
App::uses('AppController', 'Controller');
class EtiquetasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$etiquetas	= $this->paginate();
		$this->set(compact('etiquetas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Etiqueta->create();
			if ( $this->Etiqueta->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$productos	= $this->Etiqueta->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Etiqueta->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Etiqueta->save($this->request->data) )
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
			$this->request->data	= $this->Etiqueta->find('first', array(
				'conditions'	=> array('Etiqueta.id' => $id)
			));
		}
		$productos	= $this->Etiqueta->Producto->find('list');
		$this->set(compact('productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Etiqueta->id = $id;
		if ( ! $this->Etiqueta->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Etiqueta->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Etiqueta->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Etiqueta->_schema);
		$modelo			= $this->Etiqueta->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
