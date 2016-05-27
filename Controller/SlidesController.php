<?php
App::uses('AppController', 'Controller');
class SlidesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$slides	= $this->paginate();
		$this->set(compact('slides'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Slid->create();

			//arma el slug
            $this->request->data['Slid']['slug'] = strtolower(Inflector::slug($this->request->data['Slid']['nombre'], '-'));

			if ( $this->Slid->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$slideres	= $this->Slid->Slider->find('list');
		$this->set(compact('slideres'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Slid->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			//arma el slug
            $this->request->data['Slid']['slug'] = strtolower(Inflector::slug($this->request->data['Slid']['nombre'], '-'));

			if ( $this->Slid->save($this->request->data) )
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
			$this->request->data	= $this->Slid->find('first', array(
				'conditions'	=> array('Slid.id' => $id)
			));
		}
		
		$slideres	= $this->Slid->Slider->find('list');
		$ImagenActual = $this->request->data['Slid']['ruta']['mini'];
		$this->set(compact('slideres','ImagenActual'));

	}

	public function admin_delete($id = null)
	{
		$this->Slid->id = $id;
		if ( ! $this->Slid->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Slid->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Slid->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Slid->_schema);
		$modelo			= $this->Slid->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
