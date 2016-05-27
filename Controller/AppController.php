<?php
App::uses('Controller', 'Controller');
//App::uses('FB', 'Facebook.Lib');
class AppController extends Controller
{
	public $helpers		= array(
		'Session', 'Html', 'Form', 'PhpExcel'
		//, 'Facebook.Facebook'
	);
	public $components	= array(
		'Session',
		'Auth'		=> array(
			'loginAction'		=> array('controller' => 'administradores', 'action' => 'login', 'admin' => true),
			'loginRedirect'		=> '/admin',
			'logoutRedirect'	=> '/admin',
			'authError'			=> 'No tienes permisos para entrar a esta sección.',
			'authenticate'		=> array(
				'Form'				=> array(
					'userModel'			=> 'Usuario',
					'fields'			=> array(
						'username'			=> 'email',
						'password'			=> 'clave'
					)
				)
			)
		),
		'DebugKit.Toolbar',
		'RequestHandler',
		'Cookie'
		//'Facebook.Connect'	=> array('model' => 'Usuario'),
		//'Facebook'
	);

	public function beforeFilter()
	{
		/**
		 * Layout administracion y permisos publicos
		 */
		if ( ! empty($this->request->params['admin']) )
		{
			$this->layoutPath				= 'backend';
			AuthComponent::$sessionKey		= 'Auth.Administrador';
			$this->Auth->authenticate['Form']['userModel']		= 'Administrador';
		}
		else
		{
			AuthComponent::$sessionKey	= 'Auth.Usuario';
			$this->Auth->allow();
		}

		/**
		 * Logout FB
		 */
		/*
		if ( ! isset($this->request->params['admin']) && ! $this->Connect->user() && $this->Auth->user() )
			$this->Auth->logout();
		*/

		/**
		 * Detector cliente local
		 */
		$this->request->addDetector('localip', array(
			'env'			=> 'REMOTE_ADDR',
			'options'		=> array('::1', '127.0.0.1'))
		);

		/**
		 * Detector entrada via iframe FB
		 */
		$this->request->addDetector('iframefb', array(
			'env'			=> 'HTTP_REFERER',
			'pattern'		=> '/facebook\.com/i'
		));

		/**
		 * Cookies IE
		 */
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

		/***
		*	Ejecutar y renderizar la función getLogo().
		***/
		$logoHome = $this->getLogo();

		/***
		*	Ejecutar y renderizar la función getInfo().
		***/
		$info = $this->getInfo();

		$modulosDisponibles = $this->getModuleByRole();

		/* Total Solicitudes */
		$totalSolicitudes = $this->getSolicitudes();

		/* Total solicitudes de este mes*/
		$totalMes = $this->getSolicitudesMesActual();

		/* Total clientes registrados*/
		$totalClientes = $this->getRegisterClient();

		//prx($modulosDisponibles);
		$this->set(compact('logoHome','info','modulosDisponibles', 'totalSolicitudes','totalMes','totalClientes'));
		
	}

	/**

		Guarda el usuario Facebook

	*/
	public function beforeFacebookSave()
	{
		if ( ! isset($this->request->params['admin']) )
		{
			$this->Connect->authUser['Usuario']		= array_merge(array(
				'nombre_completo'	=> $this->Connect->user('name'),
				'nombre'			=> $this->Connect->user('first_name'),
				'apellido'			=> $this->Connect->user('last_name'),
				'usuario'			=> $this->Connect->user('username'),
				'clave'				=> $this->Connect->authUser['Usuario']['password'],
				'email'				=> $this->Connect->user('email'),
				'sexo'				=> $this->Connect->user('gender'),
				'verificado' 		=> $this->Connect->user('verified'),
				'edad'				=> $this->Session->read('edad')
			), $this->Connect->authUser['Usuario']);
		}

		return true;
	}

	/**

		Retorna todos los módulos por usuario.

	*/
	public function getModuleByRole(){
		$this->Modulo = $this->instanceModel( 'Modulo' );

		$modulos = $this->Modulo->find('all', array('conditions' => array('parent_id' => 0) ));
			$data = array();
			foreach ($modulos as $padre) {
				$data[] = array(
					'nombre' => $padre['Modulo']['nombre'],
					'hijos' => $this->Modulo->find(
						'all', array(
							'conditions' => array('Modulo.parent_id' => $padre['Modulo']['id'] ),
							'contain' => array('Rol'),
							'joins' => array(
								array(
									'table' => 'modulos_roles',
						            'alias' => 'md',
						            'type'  => 'INNER',
						            'conditions' => array(
						                'md.modulo_id = Modulo.id',
						                'md.rol_id' => $this->Session->read('Auth.Administrador.rol_id')
						            )
								)
							)
						)
					)
				);
		}

		return $data;
	}

	/**
		
		Obtener el nombre del Módulo Padre

	*/
	public function getParentModule($parentId){
		$this->Modulo = $this->instanceModel( 'Modulo' );
		return $this->Modulo->find('first', array('conditions' => array('id' => $parentId)));
	}


	/**

		Instancia al modelo Imágen y retorna el logo.

	*/
	public function getLogo(){
		$this->Imagen = $this->instanceModel( 'Imagen' );
		$logoHome = $this->Imagen->getList(3);
		return $logoHome;
	}


	/**

		Instancia al modelo Configuración y retorna la información del sitio.

	*/
	public function getInfo(){
		$this->Configuracion = $this->instanceModel( 'Configuracion' );
		$info = $this->Configuracion->getConfig();
		return $info;
	}

	/**

		Obtener total solicitudes

	*/
	public function getSolicitudes(){
		$this->Transaccion = $this->instanceModel( 'Transaccion' );
		return $this->Transaccion->find('count');
	}

	/**

		Obtener total solicitudes del mes actual

	*/
	public function getSolicitudesMesActual(){
		$this->Transaccion = $this->instanceModel( 'Transaccion' );
		return $this->Transaccion->find('count',array('conditions' => array('MONTH(creada)' => date('m'))));
	}

	/**

		Obtener total de usuario registrados

	*/
	public function getRegisterClient(){
		$this->Cliente = $this->instanceModel( 'Cliente' );
		return $this->Cliente->find('count');
	}


	/**

		Enviar email de contacto a propietario.

	*/
	public function sendEmailToAdmin( $data ){

		App::uses('CakeEmail', 'Network/Email');

		$Email = new CakeEmail();
		$Email->from(array('apps@brandon.cl' => 'Brandon'));
		$Email->to('cristian.rojas@brandon.cl');
		$Email->subject('Contacto desde sitio web');
		//$Email->replyTo('');
		//$Email->cc('');
		//$Email->bcc('');
		$Email->template('contacto');
		$Email->viewVars(compact('data'));
		$Email->emailFormat('html');
		$Email->send();
		
	}


	/**

		Enviar email de contacto a propietario.

	*/
	public function sendEmailReply( $data ){
		/**
		*	Completar con nombre y email
		*/
		App::uses('CakeEmail', 'Network/Email');

		$Email = new CakeEmail();
		$Email->from(array('apps@brandon.cl' => 'Brandon'));
		$Email->to('cristian.rojas@in-click.cl');
		$Email->subject('Contacto desde sitio web');
		//$Email->replyTo('');
		//$Email->cc('');
		//$Email->bcc('');
		$Email->template('reply');
		$Email->viewVars(compact('data'));
		$Email->emailFormat('html');
		$Email->send();
		
	}

	/**

		Enviar email con solicitud adjunta.

	*/
	public function sendClientEmail( $producto , $cliente , $marca , $modelo ){
		
		App::uses('CakePdf', 'Plugin/CakePdf/Pdf');
		App::uses('CakeEmail', 'Network/Email');
		
		$this->CakePdf = new CakePdf();
		$this->CakePdf->template('solicitud','default');
		$this->CakePdf->viewVars(compact('producto' ,'cliente' ,'marca' ,'modelo'));
		$this->CakePdf->write(APP . 'webroot' . DS . 'Solicitudes' . DS . 'solicitud_' . $cliente['rut'] . DS . 'solicitud_' . $cliente['rut'] . '.pdf');

		/**
		* Se envia el email
		*/
		$email = $cliente['email'];
	
		$this->Email = new CakeEmail();
		$this->Email
		->viewVars(compact('cliente'))
		->emailFormat('html')
		->from(array('apps@brandon.cl' => 'Lucasmotto.cl'))
		->to($email)
		->template('solicitud')
		->attachments(array(WWW_ROOT . 'Solicitudes' . DS . 'solicitud_' . $cliente['rut'] . DS . 'solicitud_' . $cliente['rut'] . '.pdf'))
		->subject('Solicitud Lucasmotto.cl');
		$this->Email->send();
		
	}


	/**

		Instanciar un modelo.
		
	*/
	private function instanceModel( $model ){
		return ClassRegistry::init( $model );
	}
}
