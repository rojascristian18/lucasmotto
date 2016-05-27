<?php
App::uses('AppController', 'Controller');
class ProductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$productos	= $this->paginate();
		$this->set(compact('productos'));

	}


	public function admin_add()
	{
		if ( $this->request->is('post') ) {

			$this->Producto->create();


			if( !empty( $this->request->data['ImagenProductoPrincipal'] ) ) {
				$dataId = $this->request->data['ImagenProductoPrincipal'];
				
				$this->eliminarImagenPrincipal( $dataId );

			}

			/***
			*	descarta los campos en los que no se cargaron imágenes
			*/
			foreach ($this->request->data['ImagenProducto'] as $index => $imagen) {

				if ($imagen['nombre']['error'] > 0) {
					unset($this->request->data['ImagenProducto'][$index]);
				}
			}

			/***
			*	se asegura de que sólo una imagen quede marcada como portada
			*/
			if (!empty($this->request->data['ImagenProducto'])) {
				
				$principal = Set::extract('ImagenProducto.{n}.portada', $this->request->data);
				
				if (!in_array(1, $principal)) {
					
					foreach ($this->request->data['ImagenProducto'] as &$imagen) {
						
						$imagen['portada'] = true;
						
						break;
						
					}
					
				}
				
			}

			$ImagenesEliminadas = $this->request->data['imageneseliminadas'];

			/***
			*	arma el slug
			*/
            $this->request->data['Producto']['slug'] = strtolower(Inflector::slug($this->request->data['Producto']['nombre'], '-'));

            
			if ( $this->Producto->saveAll($this->request->data) ){	

				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));

			}
			else{

				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');

			}
		}


		$modelos			= $this->Producto->Modelo->find('list');
		$tipoProductos		= $this->Producto->TipoProducto->find('list');
		$especificaciones	= $this->Producto->Especificacion->find('list');
		$etiquetas			= $this->Producto->Etiqueta->find('list');
		$proveedores		= $this->Producto->Proveedor->find('list');
		$sucursales			= $this->Producto->Sucursal->find('list');
		$transacciones		= $this->Producto->Transaccion->find('list');
		$relacionados 		= $this->Producto->find('all');
		$productosEspecificaciones 	= $this->Producto->find( 'all', array('contain' => array('Especificacion')) );
		$EspecificacionCategorias = $this->requestAction(array('controller' => 'categorias', 'action' => 'getCategory'));
		$this->set(compact('modelos', 'tipoProductos', 'especificaciones', 'etiquetas', 'proveedores', 'sucursales', 'transacciones','relacionados','productosEspecificaciones', 'EspecificacionCategorias'));
	}



	public function admin_edit($id = null)
	{
		if ( ! $this->Producto->exists($id) )
		{

			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));

		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{	
			
			if( !empty( $this->request->data['ImagenProductoPrincipal'] ) ){
				$dataId = $this->request->data['ImagenProductoPrincipal'];
				
				$this->eliminarImagenPrincipal( $dataId );

			}
			
			/***
			*	Descarta los campos en los que no se cargaron ímágenes
			*/
			foreach ($this->request->data['ImagenProducto'] as $index => $imagen) {

				if ($imagen['nombre']['error'] > 0) {
					unset($this->request->data['ImagenProducto'][$index]);
				}
			}


			$ImagenesEliminadas = $this->request->data['imageneseliminadas'];

			/***
			*	arma el slug
			*/
            $this->request->data['Producto']['slug'] = strtolower(Inflector::slug($this->request->data['Producto']['nombre'], '-'));

			$this->Producto->Relacionado->deleteAll(
                   array(
                           'Relacionado.producto_id' => $id,
                   )
           	);			

			if ( $this->Producto->saveAll($this->request->data) )
			{
				
				/***
				*	elimina de la bd y directorio las imágenes que fueron eliminadas de la vista
				*/

				if ($ImagenesEliminadas != "") {

					//Eliminar imágenes
					$ArrayEliminadas = explode(",", $ImagenesEliminadas);

					for ($i = 0; $i < count($ArrayEliminadas); $i++) {

						$this->eliminarImagenPrincipal( $ArrayEliminadas[$i] );

					}

				}

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

			$this->request->data	= $this->Producto->find('first', array(
				'conditions'	=> array('Producto.id' => $id),
				'contain'		=> array('ImagenProducto')
			));
		}


		$tieneDestacada = false;

		/***
		*	Busca la imágen principal guardada
		*/
		$imagenDestacadas = $this->Producto->ImagenProducto->find( 'first', array('conditions' => array(
			'producto_id' => $id,
			'portada' => 1),
		'order' => 'id DESC'
			) 
		);

		if (!empty($imagenDestacadas)) {

			$tieneDestacada = true;

		}

		$imagenes 					= $this->request->data['ImagenProducto'];
		$productos 					= $this->request->data['Producto'];
		$modelos					= $this->Producto->Modelo->find('list');
		$proveedores				= $this->Producto->Proveedor->find('list');
		$tipoProductos				= $this->Producto->TipoProducto->find('list');
		$especificaciones			= $this->Producto->Especificacion->find( 'list' );
		$productosEspecificaciones 	= $this->Producto->find( 'all', array('conditions' => array('id' => $id), 
			'contain' => array('Especificacion')) );
		
		$EspecificacionCategorias = $this->requestAction(array('controller' => 'categorias', 'action' => 'getCategory'));


		$relacionados = $this->Producto->find('all', array('conditions' => array('id !=' => $productos['id'])));
		$productosRelacionados = $this->Producto->Relacionado->find('all', array('conditions' => array('producto_id' => $id)));
		
		$this->set(compact('modelos', 'proveedores' , 'tieneDestacada' ,'tipoProductos', 'especificaciones','imagenes', 'productos' ,'relacionados', 'productosRelacionados', 'productosEspecificaciones', 'EspecificacionCategorias'));
	}



	public function admin_delete($id = null)
	{
		$this->Producto->id = $id;
		if ( ! $this->Producto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');

		if ( $this->Producto->delete() )
		{	

			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));

		}

		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));

	}



	public function admin_exportar()
	{
		$datos			= $this->Producto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Producto->_schema);
		$modelo			= $this->Producto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}



	/**

		Elimina de la bd y directorio las imágenes que fueron eliminadas de la vista

	*/
	public function eliminarImagenPrincipal( $id ){

		$this->Producto->ImagenProducto->id = $id;

		if ( ! $this->Producto->ImagenProducto->exists() ){
			return false;
		}
		
		if ( $this->Producto->ImagenProducto->delete() ){
			return true;
		}

	}



	/**

		Obtiene los productos destacados del Home

	*/
	public function getFeaturedHome(){

		$destacados = $this->Producto->find('all', array(
			'conditions' 	=> 	array( 'destacado' => 1 , 'estatus' => 1),
			'order'			=>	array( 'Producto.id DESC' ),
			'contain'		=>	array( 'ImagenProducto' => array( 'conditions' => array( 'portada' => 1 ) , 'limit' => 1 ) ),
			'limit'			=>	4
			) 
		);

		return $destacados;

	}

	/**

		Obtiene las categorías de los productos

	*/
	public function getCategoryProduct(){

		$categorias = $this->Producto->TipoProducto->find('all');

		return $categorias;

	}

	/**

		Obtiene producto por id

	*/
	public function getProduct( $id ){

		return $this->Producto->find( 'first', array(
			'conditions' => array('Producto.id' => $id), 
			'contain' => array('Proveedor' , 'ImagenProducto' => array( 'conditions' => array( 'portada' => 1 )) ) 
			)
		);

	}
	

	/**

		Obtiene los productos por el id de categoría

	*/
	public function getProductByCategoryId( $idCat ){

		$productos = $this->Producto->find('all', array(
				'conditions' 	=> array('tipo_producto_id' => $idCat, 'estatus' => 1),
				'contain'		=> array( 'ImagenProducto' => array('conditions' => array('portada' => 1) ) ),
				'limit'			=> 8
				)
		);

		$this->layout = 'ajax';
		$this->set(compact('productos'));

	}


	/**

		Catálogo de productos

	*/
	public function catalogo(){

			$categories = "";
			$brands = "";
			$min_price = "";
			$max_price = "";
			$details = array('');;

			if (!empty($this->request->data['tipoproducto'])) 		$categories = $this->request->data['tipoproducto'];
			if (!empty($this->request->data['marca'])) 				$brands = $this->request->data['marca'];
			if (!empty($this->request->data['precio_min'])) 		$min_price = $this->request->data['precio_min'];
			if (!empty($this->request->data['precio_max'])) 		$max_price = $this->request->data['precio_max'];
			if (!empty($this->request->data['especificaciones'])) 	$details = $this->request->data['especificaciones'];


		if( $this->request->is('post') || $this->request->is('put') ){

			$detalle 	= array();
			$condition 	= "OR";
			$campos 	= array();
			$join 		= array();

			foreach ($details as $detail) {
				if (!empty($detail)) {
					$detalle[] = $detail;
				}
			}


			/***
			*	Los filtros seleccionados son: 
			*		todos
			*/
			if ( !empty( $categories ) && !empty( $brands ) && !empty( $detalle ) && !empty( $min_price ) ) {

				$condition = "AND";
				$campos = array(
						'Producto.tipo_producto_id' => $categories,
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price),
						'Modelo.marca_id' => $brands
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);
			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría, marca y especificaciones
			*/
			if( !empty( $categories ) && !empty( $brands ) && !empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories,  
						'Modelo.marca_id' => $brands 
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría, marca y precio
			*/
			if( !empty( $categories ) && !empty( $brands ) && empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories,
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price),
						'Modelo.marca_id' => $brands 
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría, especificaciones y precio
			*/
			if( !empty( $categories ) && empty( $brands ) && !empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories, 
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price) 
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría y marca
			*/
			if( !empty( $categories ) && !empty( $brands ) && empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories,
						'Modelo.marca_id' => $brands
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría y especificaciones
			*/
			if( !empty( $categories ) && empty( $brands ) && !empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría y precio
			*/
			if( !empty( $categories ) && empty( $brands ) && empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories,
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price)
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		categoría
			*/
			if( !empty( $categories ) && empty( $brands ) && empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array( 
						'Producto.tipo_producto_id' => $categories
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Marca, especificaciones y precio
			*/
			if( empty( $categories ) && !empty( $brands ) && !empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Modelo.marca_id' => $brands,
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price) 
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Marca y especificaciones
			*/
			if( empty( $categories ) && !empty( $brands ) && !empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Modelo.marca_id' => $brands 
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Marca y precio
			*/
			if( empty( $categories ) && !empty( $brands ) && empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Modelo.marca_id' => $brands,
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price) 
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Marca
			*/
			if( empty( $categories ) && !empty( $brands ) && empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Modelo.marca_id' => $brands 
						);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Especificacion y precio
			*/
			if( empty( $categories ) && empty( $brands ) && !empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price)
						);
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Especificacion
			*/
			if( empty( $categories ) && empty( $brands ) && !empty( $detalle ) && empty( $min_price ) ){

				$condition = "AND";
				$join = array( 
						array(
				            'table' => 'especificaciones_productos',
				            'alias' => 'Especificacion',
				            'type'  => 'INNER',
				            'conditions' => array(
				                'Especificacion.producto_id = Producto.id',
				                'Especificacion.especificacion_id' => $detalle
				            )

			        	)
					);

			}


			/***
			*	Los filtros seleccionados son: 
			*		Precio
			*/
			if( empty( $categories ) && empty( $brands ) && empty( $detalle ) && !empty( $min_price ) ){

				$condition = "AND";
				$campos = array(  
						'Producto.valor BETWEEN ? AND ?' => array($min_price, $max_price)
						);

			}

			/******
			*	Arma la query
			*/
			$this->paginate = array(
				'conditions'	=> array(
				 		$condition => $campos,
				 		'Producto.estatus' => 1
				 ),
				'contain'		=> array( 
						'ImagenProducto' => array('conditions' => array('ImagenProducto.portada' => 1)), 
						'Modelo',
						'Especificacion'
				),
				'joins'			=> $join,
				'group'	=> array( 'Producto.id' ),
				'limit' => 12
			);

			/***
			*	Busqueda de Vehículos por modelo o nombre
			*/
			if( !empty( $this->request->data['search'] ) ){

				$buscar = $this->request->data['search'];

				//Buscar productos por nombre o modelo
				$queryProductos = $this->Producto->query('SELECT Producto.id FROM e_productos AS Producto 
					JOIN e_modelos AS Modelo ON(Producto.modelo_id = Modelo.id) WHERE 
					Producto.nombre LIKE "%' . $buscar . '%" OR Modelo.nombre LIKE "%' . $buscar . '%"'); 


				if (empty($queryProductos)) {

					$this->Session->setFlash('Motocicleta no encontrada.', null, array(), 'danger');
					$this->redirect(array('action' => 'catalogo'));

				}

				$arregloProductos = array();

				foreach ($queryProductos as $producto) {

					foreach ($producto['Producto'] as $key => $value) {

						$arregloProductos[] = $this->Producto->find('first' ,array(
							'conditions' => array('Producto.id' => $value),
							'contain' => array('ImagenProducto')
							));

					}

				}

				$this->set(compact('arregloProductos'));	

			} //Fin de la buqueda

			//Registra el filtro en una cookie
			$this->crearCookie( $this->paginate );
		
			$productos	= $this->paginate();

		}else{

			$this->paginate		= array(
				'conditions' => array('Producto.estatus' => 1),
				'contain' => array('ImagenProducto' => array('order' => 'portada DESC')),
				'limit'	=> 12
			);

			if (empty($this->request->params['named']['page']) ) {
				
				$this->Cookie->delete('Productos');

			}

			if( $this->Cookie->check('Productos') ){

				$result = $this->Cookie->read('Productos');

				$this->paginate = $result;

			}

			$productos	= $this->paginate();

		}

		$tipoProductos 			= $this->Producto->TipoProducto->find( 'all' );
		$marcas 				= $this->Producto->Modelo->Marca->find( 'all' );
		$categorias 			= $this->Producto->Especificacion->Categoria->find( 'all', array(
			'contain' => array( 'Especificacion' ),
			'conditions' => array( 'Categoria.parent_id !=' => 0 ) 
			)
		);
		
		
		$this->set(compact('productos' , 'tipoProductos' , 'marcas' , 'categorias'));


	}

	/**

		Cookie de productos

	*/
	public function crearCookie($data){

		$this->Cookie->write('Productos', $data);

	}


	/**

		Comparador de productos

	*/
	public function comparar(){


		if( $this->request->is('post') || $this->request->is('put') ){


			if( !empty( $this->request->data['comparar'] ) ) {

				$comparar = $this->request->data['comparar'] ;

				if ( 3 < count($comparar) || count($comparar) < 2 ) {

					$this->Session->setFlash('Error! Seleccione 2 o 3 motocicletas.', null, array(), 'danger');
					$this->redirect(array('action' => 'catalogo'));
					
				}


			}else{

				$this->Session->setFlash('Error! Seleccione motocicletas.', null, array(), 'danger');
				$this->redirect(array('action' => 'catalogo'));

			}


				$categoriaPadres = $this->Producto->Especificacion->Categoria->find( 'threaded' , array( 
					'contain'	=> array( 
						'Especificacion' => array( 
							'Producto' => array( 'conditions' => array( 'Producto.id' => $comparar , 'Producto.estatus' => 1) 
								) 
							) 
						) 
					) 
				);


				$productos = $this->Producto->find( 'all', array( 
					'conditions' => array( 'Producto.id' => $comparar ,'Producto.estatus' => 1),
					'contain'		=> array( 
						'ImagenProducto' , 
						'Modelo' => array( 'Marca' ),
						'Especificacion'
						)
					)
				);


			$this->set( compact( 'productos' , 'categoriaPadres' , 'categorias' , 'arregloBusqueda') );

		}
	}


	/**

		Ver detalles del producto
		
	*/
	public function view( $slug = null ){


		$producto = $this->Producto->find( 'first' , array( 
			'conditions' => array( 
				'Producto.slug' => $slug ,
				'Producto.estatus' => 1),
			'contain'	=> array('ImagenProducto' => array('order' => 'portada DESC' , 'limit' => 5), 'Especificacion' , 'Modelo') 
			)
		);


		if (empty($producto)) {

			$this->Session->setFlash('Motocicleta no encontrada.', null, array(), 'danger');
			$this->redirect(array('action' => 'catalogo'));

		}

		//Registrar Visita

		$visitCount = $producto['Producto']['count_visitas'] + 1;

		$visitCount = array('Producto' => array('count_visitas' => $visitCount));

		$this->Producto->id = $producto['Producto']['id'];

		$this->Producto->save( $visitCount );
		
		$categoriaPadres = $this->Producto->Especificacion->Categoria->find( 'threaded' , array( 
				'contain'	=> array( 
					'Especificacion' => array(
						'Producto' => array( 
							'conditions' => array( 
								'Producto.id' => $producto['Producto']['id'],
								'Producto.estatus' => 1
							) 
						) 
					) 
				) 
			) 
		);


		$relacionados = $this->Producto->Relacionado->find('all', array(
			'conditions' => array('producto_id' => $producto['Producto']['id']),
			'limit'	=> 4
			)
		);


		$productosRelacionados = array();


		foreach ($relacionados as $productoRelacionado) {

			$productosRelacionados[] = $this->Producto->find('all', array(
				'conditions' => array('id' => $productoRelacionado['Relacionado']['producto_relacionado_id']),
				'contain'	=> array('ImagenProducto')
				)
			);

		}

		$this->Session->write('Solicitud.producto', $producto['Producto']['id']);

		$this->set(compact('producto' , 'categoriaPadres', 'productosRelacionados'));

	}

	/**

		Data par gráficos en formato Json
		
	*/
	public function getVisits(){

			$productos = $this->Producto->find('all', array(
				'estatus' => 1,
				'order' => array('count_visitas DESC'),
				'limit' => 5));

			$arrayJson['cols'] = array(
				array(
					'id' => '' , 
					'label' => 'Moto', 
					'pattern' => '', 
					'type' => 'string') , 
				array(
					'id' => '' , 
					'label' => 'Total visitas', 
					'pattern' => '', 
					'type' => 'number') 
			);

			

			foreach ($productos as $producto) {
				$temporal[]['c']= array(
					array('v' => $producto['Producto']['nombre'] , 'f' => null),
					array('v' => $producto['Producto']['count_visitas'] , 'f' => null)
				);
			}

			$arrayJson['rows'] = $temporal;

			$this->layout = 'ajax';
			$this->set(compact('arrayJson'));

	}

	/**

		Data par gráficos en formato Json
		
	*/
	public function productoSolicitudes(){

			$productos = $this->Producto->find('all', array(
				'estatus' => 1,
				'limit' => 5,
				'contain' => array('Transaccion'),
				)
         	);

			$arrayJson['cols'] = array(
				array(
					'id' => '' , 
					'label' => 'Moto', 
					'pattern' => '', 
					'type' => 'string') , 
				array(
					'id' => '' , 
					'label' => 'Total solicitudes', 
					'pattern' => '', 
					'type' => 'number') 
			);

			foreach ($productos as $producto) {
				$temporal[]['c']= array(
					array('v' => $producto['Producto']['nombre'] , 'f' => null),
					array('v' => count($producto['Transaccion']) , 'f' => null)
				);
			}

			$arrayJson['rows'] = $temporal;
			
			$this->layout = 'ajax';
			$this->set(compact('arrayJson'));

	}

}
