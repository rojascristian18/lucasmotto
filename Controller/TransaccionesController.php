<?php
App::uses('AppController', 'Controller');
class TransaccionesController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$transacciones	= $this->paginate();
		$this->set(compact('transacciones'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{	
			$this->Transaccion->create();
			if ( $this->Transaccion->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$clientes	= $this->Transaccion->Cliente->find('list');
		$estadoTransacciones	= $this->Transaccion->EstadoTransaccion->find('list');
		$documentos	= $this->Transaccion->Documento->find('list');
		$productos	= $this->Transaccion->Producto->find('list');
		$this->set(compact('clientes', 'estadoTransacciones', 'documentos', 'productos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Transaccion->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			if ( $this->Transaccion->save($this->request->data) )
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
			$this->request->data	= $this->Transaccion->find('first', array(
				'conditions'	=> array('Transaccion.id' => $id)
			));
		}
		$clientes	= $this->Transaccion->Cliente->find('list');
		$estadoTransacciones	= $this->Transaccion->EstadoTransaccion->find('list');
		$documentos	= $this->Transaccion->Documento->find('list');
		$productos	= $this->Transaccion->Producto->find('list');
		$this->set(compact('clientes', 'estadoTransacciones', 'documentos', 'productos'));
	}

	public function admin_delete($id = null)
	{
		$this->Transaccion->id = $id;
		if ( ! $this->Transaccion->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Transaccion->delete() )
		{	
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Transaccion->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Transaccion->_schema);
		$modelo			= $this->Transaccion->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}



	/**

		Ver solicitud

	*/
	public function admin_view( $id ){
		
		$this->Transaccion->id = $id;
		if ( ! $this->Transaccion->exists() )
		{
			$this->Session->setFlash('No se encontró información.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}else{

			$solicitud = $this->Transaccion->find( 'first', array(
				'conditions' => array('Transaccion.id' => $id),
				'contain' => array(
					'Producto' => array('Modelo'),
					'EstadoTransaccion',
					'Documento' => array('TipoDocumento'),
					'Cliente' => array('TipoCliente')
					)
				) 
			);
			$this->set(compact('solicitud'));
		}

	}


	/**

		Generar PDF de solicitud

	*/
	public function admin_generarPdf( $data_id ){
		
		if ( ! $this->Transaccion->exists($data_id) ) {
			$this->Session->setFlash('No existe el registro seleccionado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$solicitud = $this->Transaccion->find( 'first', array(
				'conditions' => array('Transaccion.id' => $data_id),
				'contain' => array(
					'Producto' => array('Modelo'),
					'EstadoTransaccion',
					'Documento' => array('TipoDocumento'),
					'Cliente' => array('TipoCliente')
					)
				) 
			);

		$this->pdfConfig = array(
			'download' => true,
			'filename' => 'solictud_' . $data_id .'.pdf'
		);

		$this->set(compact('solicitud'));

	}



	/**

		Busca solicitud por rut de cliente.

	*/
	public function admin_search(){

		$rutCliente = $this->request->data['Transaccion']['rut'];

		$signos = array('/','-','.',',','_','*','/','&','%','$','#','"','!','°','|','¬',':',';','¡','¿','?','+','<','>');

		$rutSinSignos = str_replace($signos, '', $rutCliente);

		if ($this->request->is('post')) {

			$transacciones = $this->Transaccion->find('all', array(
				'contain' => array(
					'EstadoTransaccion',
					'Cliente' =>  array('conditions' => array('Cliente.rut' => $rutCliente)))
				)
			);

			foreach ($transacciones as $index => $transaccion) {
				if(empty($transaccion['Cliente']['id'])){

					unset($transacciones[$index]);

				}
			}

			if(empty($transacciones)){

				$this->Session->setFlash('No se encontraron registros.', null, array(), 'danger');
				return;
			}

			$this->Session->setFlash('Solicitudes encontradas.', null, array(), 'success');
			$this->set(compact('transacciones'));

		}else{

			$this->Session->setFlash('No se encontraron registros.', null, array(), 'danger');

			$this->redirect(array('action' => 'index'));

		}

	}


	/**

		Registra Solicitud

	*/
	public function solicitud(){
		
		if ($this->Session->check('Solicitud.identificador')) {

			$solicitud = $this->Session->read('Solicitud.identificador');
			$this->set(compact('solicitud'));

		}else{

			if ( $this->request->is('post') || $this->request->is('put') ){
				
				if ($this->Session->check('Solicitud.producto') == $this->request->data['Transaccion']['producto_id'] ) {

					$clienteRut = $this->request->data['Cliente']['rut'];
					$clienteEmail = $this->request->data['Cliente']['email'];
					$clienteFono = $this->request->data['Cliente']['fono'];
					$slug = $this->request->data['Transaccion']['slug'];
					$productoId = $this->request->data['Transaccion']['producto_id'];

					if( $this->consultarCliente($clienteRut) == 'noValido' ){

						$this->Session->setFlash('El rut ingresado no es válido.', null, array(), 'danger');
						$this->redirect(array('controller' => 'productos','action' => 'view', $slug));
					
					}

					if( empty($this->consultarCliente($clienteRut)) ){

						$this->registrarCliente($this->request->data);
						
					}


					if( !empty($this->consultarCliente($clienteRut)) ){

						$dataCliente = $this->consultarCliente($clienteRut);

						$dataCliente['Cliente']['email'] = $clienteEmail;
						$dataCliente['Cliente']['fono'] = $clienteFono;
						
						$data['Producto']['Producto'][] = $productoId;
						$data['Transaccion']['cliente_id'] = $dataCliente['Cliente']['id'];
						$data['Transaccion']['estado_transaccion_id'] = 3; //Estado pre-aprobado
						$data['Transaccion']['valor'] = $this->request->data['Transaccion']['valor'];
						$data['Cliente'] = $dataCliente['Cliente'];

						if( $this->Transaccion->saveAll($data, array(
								    'fieldList' => array(
								        'Cliente' => array('email','fono')
								    	)
						    		) 
						    	) 
							){

							$solicitud = $this->getSolicitud();

							$this->Session->write('Solicitud.identificador', $solicitud);

							$this->generarPdfSolicitudEmail( $solicitud );

							$this->set(compact('solicitud'));

						}else{
							
							$this->Session->setFlash('Error al crear la solicitud. Por favor intente nuevamente.', null, array(), 'danger');
							$this->redirect(array('controller' => 'productos' , 'action' => 'view', $slug));
						}
					}
				
			}else{

				$this->Session->setFlash('La solicitud ya fue creada.', null, array(), 'danger');
				$this->redirect(array('controller' => 'productos' , 'action' => 'catalogo'));

			}

		}else{

			$this->redirect(array('controller' => 'productos','action' => 'catalogo'));

		}

		}
	}



	/**

		Consultar rut de cliente

	*/
	public function consultarCliente( $rut ){

		$rut = array('rut' => $rut);

		if( $this->Transaccion->rutChileno($rut) ){

			$rut = str_replace("-", "", $rut['rut']);
			
			return $this->Transaccion->Cliente->find( 'first', array('conditions' => array('rut' => $rut)) );

		}else{

			return "noValido";

		}
	}

	/**

		Registrar cliente nuevo

	*/
	public function registrarCliente( $data ){

		$data['Cliente']['rut'] = str_replace("-", "", $data['Cliente']['rut']);
		
		if ( $this->Transaccion->Cliente->save($data['Cliente']) ){

			return true;

		}else{

			$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.', null, array(), 'danger');
			$this->redirect(array('controller' => 'productos','action' => 'view', $data['Transaccion']['slug']));

		}

	}

	/**

		Obtener información de la moto

	*/
	function getProduct($motoId){

		return $this->requestAction(array('controller' => 'productos', 'action' => 'getProduct', $motoId));

	}

	/**

		Obtener última solicitud

	*/
	function getSolicitud(){

		$solicitud = $this->Transaccion->find( 'first', array('order' => 'id DESC','fields' => 'id') );
		return $solicitud['Transaccion']['id'];

	}

	/**

		Obtener data completa de una solicitud por Id

	*/
	function getSolicitudData( $id ){

		return $this->Transaccion->find( 'all', array(
			'conditions' 	=> array('Transaccion.id' => $id),
			'contain'		=> array(
				'Producto' => array(
					'Proveedor' , 
					'ImagenProducto' => array('conditions' => array('ImagenProducto.portada' => 1)), 
					'Modelo' => array('Marca')),
				'Cliente')
			) 
		);

	}

	/**

		Generar PDF de solicitud

	*/
	function generarPdfSolicitud( $id ){		
		
		$producto = array();
		$cliente = array();
		$marca = "";
		$modelo = "";
		
		$data = $this->getSolicitudData( $id );

		foreach ($data as $solicitud) {
			$producto = $solicitud['Producto'];
			$cliente = $solicitud['Cliente'];
		}

		foreach ($producto as $modelos) {
			$marca = $modelos['Modelo']['Marca']['nombre'];
			$modelo = $modelos['Modelo']['nombre'];
		}
				
		$this->pdfConfig = array(
			'download' => true,
			'filename' => 'solictud_' . $cliente['rut'] .'.pdf'
		);

		$this->set(compact('data', 'cliente', 'producto', 'marca', 'modelo'));

	}


	/**

		Generar PDF de solicitud y adjuntar a email

	*/
	function generarPdfSolicitudEmail( $id ){		
		
		$producto = array();
		$cliente = array();
		$marca = "";
		$modelo = "";
		
		$data = $this->getSolicitudData( $id );

		foreach ($data as $solicitud) {
			$producto = $solicitud['Producto'];
			$cliente = $solicitud['Cliente'];
		}

		foreach ($producto as $modelos) {
			$marca = $modelos['Modelo']['Marca']['nombre'];
			$modelo = $modelos['Modelo']['nombre'];
		}

		$this->sendClientEmail($producto,$cliente,$marca,$modelo);
	}


	/**

		Cerrar sesión

	*/
	public function quit(){

		$this->Session->delete('Solicitud');
		$this->redirect( array('controller' => 'productos','action' => 'catalogo') );

	}


	/**

		Obtener Transacciones y enviarlas por Json

	*/
	public function getTransacciones($cantidadMeses = null){

		App::uses('CakeTime', 'Utility');

		$transaccionTotal = $this->Transaccion->query("SELECT COUNT(id),MONTH(creada) FROM e_transacciones GROUP BY MONTH(creada)");

		$mesSuperior = date('n');
		
		$mesInferior = date('n', strtotime('-3 month'));

		if ( !is_null($cantidadMeses) ) {
			
			$mesInferior = date('n', strtotime('-'. $cantidadMeses .' month'));
			
		}
		
		$meses = array('1','2','3','4','5','6','7','8','9','10','11','12');

		$mesesNombre = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

		$mesesNumero = array();
		$valores = array();

		

		if ($mesInferior < $mesSuperior) {
			
			for ($j=$mesInferior-1; $j < $mesSuperior; $j++) { 
				$mesesNumero[] = $meses[$j];
			}

		}else{
			for ($i=$mesInferior; $i <= 12 ; $i++) {
				$mesesNumero[] = $meses[$i-1];
			}
			for ($j=0; $j < $mesSuperior; $j++) { 
				$mesesNumero[] = $meses[$j];
			}
		}

		

		for ($x=0; $x < count($mesesNumero); $x++) { 
			$valores[$x] = 0;
		}

		foreach ($transaccionTotal as $index => $transaccion) {

			foreach ($transaccion as $value) {

				if(in_array($value['MONTH(creada)'], $mesesNumero)){

					$posicion = array_search($value['MONTH(creada)'], $mesesNumero);

					$valores[$posicion] += $value['COUNT(id)'];

				}
			}
		}

		$jsonArray = array();

		$jsonArray = array('Meses' => $mesesNumero , 'Valores' => $valores);

		$arregloFinal = array();

		$arregloFinal['cols'][] = array(
			'id' => '' , 
			'label' => 'Meses', 
			'pattern' => '', 
			'type' => 'string'
		);

		$arregloFinal['cols'][] = array(
			'id' => '' , 
			'label' => 'Total solicitudes', 
			'pattern' => '', 
			'type' => 'number'
		);

		foreach ($jsonArray['Meses'] as $key => $value) {

			$arregloFinal['rows'][]['c'] = array( 
				array( 
					'v' => $mesesNombre[$value -1] , 'f' => null ), 
				array(
					'v' => $jsonArray['Valores'][$key] , 'f' => null) 
			);

		}

		$this->layout = 'ajax';
		$this->set(compact('arregloFinal','mesesNumero','mesInferior'));	
	}

}
