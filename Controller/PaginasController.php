<?php
App::uses('AppController', 'Controller');
class PaginasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$paginas	= $this->paginate();
		$this->set(compact('paginas'));
	}



	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Pagina->create();
			//arma el slug
            $this->request->data['Pagina']['slug'] = strtolower(Inflector::slug($this->request->data['Pagina']['nombre'], '-'));

			if ( $this->Pagina->save($this->request->data) )
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
		if ( ! $this->Pagina->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			//arma el slug
            $this->request->data['Pagina']['slug'] = strtolower(Inflector::slug($this->request->data['Pagina']['nombre'], '-'));
            
			if ( $this->Pagina->save($this->request->data) )
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
			$this->request->data	= $this->Pagina->find('first', array(
				'conditions'	=> array('Pagina.id' => $id)
			));
		}
	}



	public function admin_delete($id = null)
	{
		$this->Pagina->id = $id;
		if ( ! $this->Pagina->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Pagina->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}



	public function admin_exportar()
	{
		$datos			= $this->Pagina->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Pagina->_schema);
		$modelo			= $this->Pagina->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	/**
		Página Quiénes Somos
	*/
	public function quienes_somos(){

		$imagenPrincipal = $this->requestAction(array('controller' => 'imagenes', 'action' => 'getImageByPosition', 4));
		$imagenFooter = $this->requestAction(array('controller' => 'imagenes', 'action' => 'getImageByPosition', 5));
		$contenidos = $this->Pagina->Contenido->find('all', array('conditions' => array('pagina_id' => 1)));

		$this->set(compact('contenidos', 'imagenPrincipal' , 'imagenFooter'));
	}


	/**
		Página Contacto
	*/
	public function contacto(){

		if ( $this->request->is('post') || $this->request->is('put') ){

			/**
			*	Validar Campos
			*/

			$nombre 	= $this->request->data['Pagina']['nombre'];
			$apellido 	= $this->request->data['Pagina']['apellido'];
			$email 		= $this->request->data['Pagina']['email'];
			$fono 		= $this->request->data['Pagina']['fono'];
			$mensaje 	= $this->request->data['Pagina']['mensaje'];


			if (empty($nombre) || empty($email) || empty($mensaje)) {

				$this->Session->setFlash('Error al enviar el mensaje. Intente nuevamente.', null, array(), 'danger');
				$this->redirect(array('action' => 'contacto'));

			}

			if(empty($apellido)) $apellido = "No especificado";

			if(empty($fono)) $fono = "No especificado";

			$guardarContacto = $this->requestAction(array('controller' => 'contactos', 'action' => 'guardarContacto', $nombre, $apellido, $email, $fono, $mensaje));
			

			if ( $guardarContacto == true) {

				$this->sendEmailToAdmin($this->request->data);
				$this->Session->setFlash('Mensaje enviado con éxito', null, array(), 'success');
				$this->redirect(array('action' => 'contacto'));

			}else{

				$this->Session->setFlash('Error al enviar el mensaje. Intente nuevamente.', null, array(), 'danger');
				$this->redirect(array('action' => 'contacto'));

			}

		}

		$contenidos = $this->Pagina->Contenido->find('all', array('conditions' => array('pagina_id' => 2)));

		$this->set(compact('contenidos'));
	}
}
