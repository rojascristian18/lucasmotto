<?php
App::uses('AppModel', 'Model');
class Marca extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		
		'Image'		=> array(
			'fields'	=> array(
				'imagen_marca'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 90,
							'height'	=> 90,
							'crop'		=> true
						)
					)
				)
			)
		)
		
	);

	/**
	 * VALIDACIONES
	 */

	/**
	 * ASOCIACIONES
	 */
	public $hasMany = array(
		'Modelo' => array(
			'className'				=> 'Modelo',
			'foreignKey'			=> 'marca_id',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		)
	);
}
