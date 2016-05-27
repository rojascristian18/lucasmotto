<?php
App::uses('AppModel', 'Model');
class TipoProducto extends AppModel
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
				'ruta'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 90,
							'height'	=> 90,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'banner',
							'width'		=> 980,
							'height'	=> 250,
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
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
	);

	/**
	 * ASOCIACIONES
	 */
	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'tipo_producto_id',
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
