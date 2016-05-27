<?php
App::uses('AppModel', 'Model');
class Configuracion extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $useTable		= 'configuracion';

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		/*
		'Image'		=> array(
			'fields'	=> array(
				'imagen'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				)
			)
		)
		*/
	);

	/**
	 * VALIDACIONES
	 */

	public function getConfig(){
		$config = $this->find( 'first' );
		return $config;
	}
}
