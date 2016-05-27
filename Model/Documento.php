<?php
App::uses('AppModel', 'Model');
class Documento extends AppModel
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
			)
		)
		
	);

	/**
	 * ASOCIACIONES
	 */
	public $belongsTo = array(
		'TipoDocumento' => array(
			'className'				=> 'TipoDocumento',
			'foreignKey'			=> 'tipo_documento_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'TipoDocumento')
		)
	);
	public $hasAndBelongsToMany = array(
		'Transaccion' => array(
			'className'				=> 'Transaccion',
			'joinTable'				=> 'documentos_transacciones',
			'foreignKey'			=> 'documento_id',
			'associationForeignKey'	=> 'transaccion_id',
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


}
