<?php
App::uses('AppController', 'Controller');
class ClientesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);

		$clientes	= $this->paginate();
		$this->set(compact('clientes'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Cliente->create();
			if ( $this->Cliente->save($this->request->data) )
			{	

				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tipoClientes	= $this->Cliente->TipoCliente->find('list');
		$estadoCiviles	= $this->Cliente->EstadoCivil->find('list');
		$this->set(compact('tipoClientes', 'estadoCiviles'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Cliente->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Cliente->save($this->request->data) )
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
			$this->request->data	= $this->Cliente->find('first', array(
				'conditions'	=> array('Cliente.id' => $id)
			));
		}
		$tipoClientes	= $this->Cliente->TipoCliente->find('list');
		$estadoCiviles	= $this->Cliente->EstadoCivil->find('list');
		$this->set(compact('tipoClientes', 'estadoCiviles'));
	}

	public function admin_delete($id = null)
	{
		$this->Cliente->id = $id;
		if ( ! $this->Cliente->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Cliente->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Cliente->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Cliente->_schema);
		$modelo			= $this->Cliente->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	/**

		Prefil del cliente

	*/
	public function admin_profile($clientID = null){

		if ( ! $this->Cliente->exists($clientID) ) {
			$this->Session->setFlash('No existe el usuario seleccionado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$direcciones = $this->Cliente->Direccion->find('all', array(
				'conditions' => array('cliente_id' => $clientID),
				'contain' => array(
					'TipoDireccion', 
					'Comuna' => array('Region')
					)
				)
			);
		
		$transacciones = $this->Cliente->Transaccion->find('all', array(
				'conditions' => array('cliente_id' => $clientID),
				'contain' => array(
					'EstadoTransaccion'
					)
				)
			);

		$cliente = $this->Cliente->find('first', array(
				'conditions' => array('Cliente.id' => $clientID),
				'contain' => array('TipoCliente','EstadoCivil')
				)
			);

		$this->set(compact('cliente','transacciones','direcciones'));

	}

	/**

		Exportar perfil a PDF

	*/
	public function admin_exportarPerfilCliente($clientId){

		if ( ! $this->Cliente->exists($clientId) ) {
			$this->Session->setFlash('No existe el usuario seleccionado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$direcciones = $this->Cliente->Direccion->find('all', array(
				'conditions' => array('cliente_id' => $clientId),
				'contain' => array(
					'TipoDireccion', 
					'Comuna' => array('Region')
					)
				)
			);
		
		$transacciones = $this->Cliente->Transaccion->find('all', array(
				'conditions' => array('cliente_id' => $clientId),
				'contain' => array(
					'EstadoTransaccion'
					)
				)
			);

		$cliente = $this->Cliente->find('first', array(
				'conditions' => array('Cliente.id' => $clientId),
				'contain' => array('TipoCliente','EstadoCivil')
				)
			);

		$this->pdfConfig = array(
			'download' => true,
			'filename' => 'profile_' . $cliente['Cliente']['nombre'] .'.pdf'
		);


		$this->set(compact('cliente','transacciones','direcciones'));

	}
}
