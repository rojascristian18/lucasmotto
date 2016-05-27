<?php
App::uses('AppController', 'Controller');
class DireccionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$direcciones	= $this->paginate();
		$this->set(compact('direcciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Direccion->create();
			if ( $this->Direccion->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$comunas	= $this->Direccion->Comuna->find('list');
		$tipoDirecciones	= $this->Direccion->TipoDireccion->find('list');
		$clientes	= $this->Direccion->Cliente->find('list');
		$this->set(compact('comunas', 'tipoDirecciones', 'clientes'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Direccion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Direccion->save($this->request->data) )
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
			$this->request->data	= $this->Direccion->find('first', array(
				'conditions'	=> array('Direccion.id' => $id)
			));
		}
		$comunas	= $this->Direccion->Comuna->find('list');
		$tipoDirecciones	= $this->Direccion->TipoDireccion->find('list');
		$clientes	= $this->Direccion->Cliente->find('list');
		$this->set(compact('comunas', 'tipoDirecciones', 'clientes'));
	}

	public function admin_delete($id = null)
	{
		$this->Direccion->id = $id;
		if ( ! $this->Direccion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Direccion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Direccion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Direccion->_schema);
		$modelo			= $this->Direccion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
