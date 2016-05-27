<div class="page-title">
	<h2><span class="fa fa-user"></span> Bienvenido <? echo $user;?></h2>
</div>

<div class="page-content-wrap">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Información del sistema</h3>
			<button onclick="drawChart();" class="btn btn-default btn-graficos pull-right">Actualizar Gráficos</button>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<!-- START WIDGET SLIDER -->
                    <div class="widget widget-default widget-carousel">
                        <div class="owl-carousel" id="owl-example">
                            <div>                                    
                                <div class="widget-title">Total Solicitudes</div>                                                                        
                                <div class="widget-subtitle">al <?=date('d-m-Y H:m:s'); ?></div>
                                <div class="widget-int"><?=$totalSolicitudes;?></div>
                            </div>
                            <div>                                    
                                <div class="widget-title">Total solicitudes</div>
                                <div class="widget-subtitle">del mes</div>
                                <div class="widget-int"><?=$totalMes;?></div>
                            </div>
                        </div>                                                        
                    </div>         
                    <!-- END WIDGET SLIDER -->
				</div>
				<div class="col-md-4">
					<!-- START WIDGET REGISTRED -->
                    <div class="widget widget-default widget-item-icon">
                        <div class="widget-item-left">
                            <span class="fa fa-user"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?=$totalClientes;?></div>
                            <div class="widget-title">Clientes registrados</div>
                            <div class="widget-subtitle">en su sitio web</div>
                        </div>                      
                    </div>                            
                    <!-- END WIDGET REGISTRED -->
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<!-- START WIDGET CLOCK -->
                    <div class="widget widget-danger widget-padding-lg">
                        <div class="widget-big-int plugin-clock">00:00</div>                            
                        <div class="widget-subtitle plugin-date">Cargando...</div>
                    </div>                        
                    <!-- END WIDGET CLOCK -->
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					<div class="grafico-container">
						<div class="form-group text-left">
							<label for="#mesesSolicitudes" class="grafico-label">Meses a mostrar</label>
							<select id="mesesSolicitudes" class="form-control" style="max-width:200px; display:inline-block;">
								<option>Seleccione</option>
								<option value="1">2 Meses</option>
								<option value="2">3 Meses</option>
								<option value="3">4 Meses</option>
								<option value="4">5 Meses</option>
								<option value="5">6 Meses</option>
								<option value="6">7 Meses</option>
								<option value="7">8 Meses</option>
								<option value="8">9 Meses</option>
								<option value="9">10 Meses</option>
								<option value="10">11 Meses</option>
								<option value="11">1 año</option>
							</select>
						</div>
						<div id="solicitudesClientes"></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
					<div class="grafico-container">
						<div id="visitasMoto"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
					<div class="grafico-container">
						<div id="solicitudesProductos"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 	<script type="text/javascript">

 	/********************************************************************
 	 Gráficos de Google
 	********************************************************************/

    	google.charts.load('current', {'packages':['bar']});
      	google.charts.setOnLoadCallback(drawChart);
      	google.charts.setOnLoadCallback(drawChartVisit);
      	google.charts.setOnLoadCallback(drawChartProduct);

      	var valores = [];
      	var array = new Array();
      	var response;


      	$(document).on('change','#mesesSolicitudes', function(){
      		valor = $(this).val();
      		drawChart(valor);
      	});

      	//Dibujar gráfico de total solicitudes por mes
		function drawChart(meses = null) {
			if (meses == null) {
				meses = '';
			};
			var jsonData = $.ajax({
	          url: webroot + 'transacciones/getTransacciones/' + meses,
	          dataType: "json",
	          async: false
	          }).responseText;

			var data = new google.visualization.DataTable(jsonData);
			
			var options = {
			  chart: {
			    title: 'Solicitudes',
			    subtitle: 'Solicitudes realizadas este año'
			  }
			};

			var chart = new google.charts.Bar(document.getElementById('solicitudesClientes'));

			chart.draw(data, options);
				
		}

		//Dibujar gráfico de total visitas por moto
      	function drawChartVisit(){

      		var jsonDataVisits = $.ajax({
	          url: webroot + 'productos/getVisits',
	          dataType: "json",
	          async: false
	          }).responseText;

      		var dataVisits = new google.visualization.DataTable(jsonDataVisits);

			var optionsVisits = {
			  chart: {
			    title: 'Visitas',
			    subtitle: 'Visitas por moto'
			  }
			};

			var chartVisits = new google.charts.Bar(document.getElementById('visitasMoto'));

			chartVisits.draw(dataVisits, optionsVisits);
      	}

      	//Dibujar gráfico de total solicitudes por moto
      	function drawChartProduct(){

      		var jsonDataProduct = $.ajax({
	          url: webroot + 'productos/productoSolicitudes',
	          dataType: "json",
	          async: false
	          }).responseText;
      		
			var dataProduct = new google.visualization.DataTable(jsonDataProduct);

			var optionsProduct = {
			  chart: {
			    title: 'Solicitudes',
			    subtitle: 'Solicitudes por moto'
			  }
			};

			var chartProduct = new google.charts.Bar(document.getElementById('solicitudesProductos'));

			chartProduct.draw(dataProduct, optionsProduct);
      	}

	</script>

