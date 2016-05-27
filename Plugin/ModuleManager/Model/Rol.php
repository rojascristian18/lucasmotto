<?php

App::uses('AppModel', 'Model');

class Rol extends AppModel {

	public $name = 'Rol';

	protected $_schema = array(
	    'nombre' => array(
	        'type' => 'string',
	        'length' => 50
	    )
	);
	

}
