<?php
App::uses('AppController', 'Controller');
class ConfiguracionesController extends AppController
{
	public function index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$configuraciones	= $this->paginate();
		$this->set(compact('configuraciones'));
	}

	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$configuraciones	= $this->paginate();
		$this->set(compact('configuraciones'));
	}


	public function admin_edit($id = null)
	{
		if ( ! $this->Configuracion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Configuracion->save($this->request->data) )
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
			$this->request->data	= $this->Configuracion->find('first', array(
				'conditions'	=> array('Configuracion.id' => $id)
			));
		}
	}

}
