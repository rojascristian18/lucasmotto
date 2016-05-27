<?php
App::uses('AppController', 'Controller');
class TipoProductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$tipoProductos	= $this->paginate();
		$this->set(compact('tipoProductos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->TipoProducto->create();
			//arma el slug
            $this->request->data['TipoProducto']['slug'] = strtolower(Inflector::slug($this->request->data['TipoProducto']['nombre'], '-'));

			if ( $this->TipoProducto->save($this->request->data) )
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
		if ( ! $this->TipoProducto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			//arma el slug
            $this->request->data['TipoProducto']['slug'] = strtolower(Inflector::slug($this->request->data['TipoProducto']['nombre'], '-'));
            	
			if ( $this->TipoProducto->save($this->request->data) )
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
			$this->request->data	= $this->TipoProducto->find('first', array(
				'conditions'	=> array('TipoProducto.id' => $id)
			));
		}

		$ImagenActual = $this->request->data['TipoProducto']['ruta']['mini'];
		$this->set(compact('ImagenActual'));
	}

	public function admin_delete($id = null)
	{
		$this->TipoProducto->id = $id;
		if ( ! $this->TipoProducto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->TipoProducto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->TipoProducto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->TipoProducto->_schema);
		$modelo			= $this->TipoProducto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
