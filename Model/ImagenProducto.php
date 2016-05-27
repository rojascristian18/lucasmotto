<?php

App::uses('AppModel', 'Model');

class ImagenProducto extends AppModel

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

				'nombre'	=> array(

					'versions'	=> array(

						array(

							'prefix'	=> 'mini',

							'width'		=> 150,

							'height'	=> 150,

							'crop'		=> true

						),
						array(

							'prefix'	=> 'principal',

							'width'		=> 500,

							'height'	=> 500,

							'crop'		=> true

						),
						array(
							'prefix' 	=> 'galeria',
							'width'		=> 120,
							'height'	=> 120,
							'crop' 		=> true
							),
						array(
							'prefix' 	=> 'item',
							'width'		=> 215,
							'height'	=> 175,
							'crop' 		=> true
							)

					)

				)

			)

		)

		

	);



	/**

	 * VALIDACIONES

	 */

	public $validate = array();

	/*
	public $validate = array(

		'nombre' => array(

			'notempty' => array(

				'rule'			=> array('notempty'),

				'last'			=> true,

				//'message'		=> 'Mensaje de validación personalizado',

				//'allowEmpty'	=> true,

				//'required'		=> false,

				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'

			),

		),

		'portada' => array(

			'boolean' => array(

				'rule'			=> array('boolean'),

				'last'			=> true,

				//'message'		=> 'Mensaje de validación personalizado',

				//'allowEmpty'	=> true,

				//'required'		=> false,

				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'

			),

		)

	);
	*/



	/**

	 * ASOCIACIONES

	 */

	public $belongsTo = array(

		'Producto' => array(

			'className'				=> 'Producto',

			'foreignKey'			=> 'producto_id',

			'conditions'			=> '',

			'fields'				=> '',

			'order'					=> '',

			'counterCache'			=> true,

			//'counterScope'			=> array('Asociado.modelo' => 'Producto')

		)

	);

}

