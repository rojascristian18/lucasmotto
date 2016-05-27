<?php
App::uses('AppModel', 'Model');
class Imagen extends AppModel
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
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'principal',
							'width'		=> 460,
							'height'	=> 280,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'full',
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

	/**
	 * ASOCIACIONES
	 */
	public $belongsTo = array(
		'SliderPosicion' => array(
			'className'				=> 'SliderPosicion',
			'foreignKey'			=> 'slider_posicion_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'SliderPosicion')
		)
	);

	//Array de imágenes por ubicación.
	public function getList( $ubicacionId ){

		$listaImagenes = $this->find('first', array(
										           'conditions' => array(
										                   'Imagen.estatus' => '1',
										                   'Imagen.slider_posicion_id' => $ubicacionId
										           )
           									)
		 							);

		return $listaImagenes;

	}
}
