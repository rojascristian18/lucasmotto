<?php
App::uses('AppModel', 'Model');
class Administrador extends AppModel
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
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule'			=> array('email'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'clave' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'repetir_clave' => array(
			'repetirClave' => array(
				'rule'			=> array('repetirClave'),
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
	public $belongsTo = array(
		'Rol' => array(
			'className'				=> 'Rol',
			'foreignKey'			=> 'rol_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Rol')
		)
	);
	public $hasAndBelongsToMany = array(
		'Concesionario' => array(
			'className'				=> 'Concesionario',
			'joinTable'				=> 'administradores_concesionarios',
			'foreignKey'			=> 'administrador_id',
			'associationForeignKey'	=> 'concesionario_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);

	public $hasMany = array(
		'Log' => array(
			'className'				=> 'Log',
			'foreignKey'			=> 'administrador_id',
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

	/**
	 * CALLBACKS
	 */
	public function beforeSave($options = array())
	{
		if ( isset($this->data[$this->alias]['clave']) )
		{
			if ( trim($this->data[$this->alias]['clave']) == false )
			{
				unset($this->data[$this->alias]['clave'], $this->data[$this->alias]['repetir_clave']);
			}
			else
			{
				$this->data[$this->alias]['clave']	= AuthComponent::password($this->data[$this->alias]['clave']);
			}
		}
		return true;
	}
}
