<?php
App::uses('AppController', 'Controller');
class SliderPosicionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$sliderPosiciones	= $this->paginate();
		$this->set(compact('sliderPosiciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->SliderPosicion->create();
			if ( $this->SliderPosicion->save($this->request->data) )
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
		if ( ! $this->SliderPosicion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->SliderPosicion->save($this->request->data) )
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
			$this->request->data	= $this->SliderPosicion->find('first', array(
				'conditions'	=> array('SliderPosicion.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->SliderPosicion->id = $id;
		if ( ! $this->SliderPosicion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->SliderPosicion->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->SliderPosicion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->SliderPosicion->_schema);
		$modelo			= $this->SliderPosicion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

}
