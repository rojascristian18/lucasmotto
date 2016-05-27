<?php
App::uses('AppController', 'Controller');
class DocumentosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$documentos	= $this->paginate();
		$this->set(compact('documentos'));
	}

	public function admin_add()
	{

		if ( $this->request->is('post') )
		{

			$this->Documento->create();
			if ( $this->Documento->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$tipoDocumentos	= $this->Documento->TipoDocumento->find('list');
		$transacciones	= $this->Documento->Transaccion->find('list');
		$this->set(compact('tipoDocumentos', 'transacciones'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Documento->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			
			if ( $this->Documento->save($this->request->data) )
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
			$this->request->data	= $this->Documento->find('first', array(
				'conditions'	=> array('Documento.id' => $id)
			));
		}
		$tipoDocumentos	= $this->Documento->TipoDocumento->find('list');
		$transacciones	= $this->Documento->Transaccion->find('list');
		$this->set(compact('tipoDocumentos', 'transacciones'));
	}

	public function admin_delete($id = null)
	{
		$this->Documento->id = $id;
		if ( ! $this->Documento->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Documento->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Documento->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Documento->_schema);
		$modelo			= $this->Documento->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	/* 
		Verifica si un archivo es válido o no 
	*/

	public function isUploadedFile($params) {
	    $val = array_shift($params);
	    if ((isset($val['error']) && $val['error'] == 0) ||
	        (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')
	    ) {
	        return is_uploaded_file($val['tmp_name']);
	    }
	    return false;
	}
}
