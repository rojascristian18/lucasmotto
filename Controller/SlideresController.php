<?php
App::uses('AppController', 'Controller');
class SlideresController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$slideres	= $this->paginate();
		$this->set(compact('slideres'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Slider->create();
			if ( $this->Slider->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$sliderPosiciones	= $this->Slider->SliderPosicion->find('list');
		$this->set(compact('sliderPosiciones'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Slider->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Slider->save($this->request->data) )
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
			$this->request->data	= $this->Slider->find('first', array(
				'conditions'	=> array('Slider.id' => $id)
			));
		}
		$sliderPosiciones	= $this->Slider->SliderPosicion->find('list');
		$this->set(compact('sliderPosiciones'));
	}

	public function admin_delete($id = null)
	{
		$this->Slider->id = $id;
		if ( ! $this->Slider->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Slider->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Slider->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Slider->_schema);
		$modelo			= $this->Slider->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	public function getSlideresByPosition( $idPosicion ){

		$todayIs = date("Y-m-d");

		$array = $this->Slider->find( 'first', array(
											'conditions' => array(
														'slider_posicion_id' => $idPosicion
														),
											'contain'	=> array( 'Slid' )
											) 
										);
		return $array;
	}

}
