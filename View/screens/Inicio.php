

	<?php if($_SESSION["rol"] == "director"){?>

		<div class="pepe" style="margin:auto;">
			<div style="display:flex; justify-content: space-between;">

				<div id="grafico1" style="width:50%">
					<canvas id="myChart" width="300" height="150"></canvas>
				</div>

				<div id="ComponentCardDashboard" class="carddashboard">	
				    <div class="box_card_total">

					   	<label >Total de estudiantes:</label>
					   	<p id="CompCardDashboardTE"></p>
					</div>
				    <div class="box_card_total">
					   	<label>Total de apoderados:</label>
					   	<p id ="CompCardDashboardTA"></p>
					</div>
				    <div class="box_card_total">
						<label>Total de materiales registrados:</label>
					   	<p id="CompCardDashboardTM"></p>
					</div>
				</div>

			</div>
			<div class="userControlComponent">
					<table class="tblUserControlComponent">
					  	<thead>
						    <tr>
						      <th>Nombre</th>
						      <th>Email</th>
						      <th>Rol</th>
						      <th>Estado</th>
						      <th>Ultima Fecha y Hora de Acceso</th>
						    </tr>
						</thead>
					    <tbody id="component_litle_table_users">
		            	</tbody>
				  	</table>
			</div>
			<div style="display:flex;justify-content: space-between;margin-top:20px;">
				<div style="background: yellow;width:45%;height:280px;">
				</div>
				<div style="background: green;width:45%;height:280px;">
				</div>
			</div>

			<h3>Director</h3>

			<?php date_default_timezone_set('America/Lima');?>
	<?php }else{ ?>
		<div style="margin:auto;">
			<div style="display:flex;justify-content: space-between;">

        <div style="background: yellow;width:45%;height:280px;">

				</div>
		
				<!-- <div style="background: green;width:45%;height:280px;">
					
				</div> -->
				<div id="ComponentCardDashboard" class="carddashboard">	
				    <div class="box_card_total">
					   	<label >Total de estudiantes:</label>
					   	<p id="CompCardDashboardTE"></p>
					</div>
				    <div class="box_card_total">
					   	<label>Total de apoderados:</label>
					   	<p id ="CompCardDashboardTA"></p>
					</div>
				    <div class="box_card_total">
						<label>Total de materiales registrados:</label>
					   	<p id="CompCardDashboardTM"></p>
					</div>	   

				</div>
			</div>
		<!-- s -->
			<div class="componentLastPayAPAFA">
				<header class="titleLastPayApafa">
					<h2>Detalle del ultimo Pago Apafa Generado:</h2>
				</header>
			        <div class="compLastPayAPAFADivs">
				        <label><strong>Nombre y Apellido Apoderado:</strong></label>
				        <p id="CompLastPayAPAFANameA"; class="contenidoLastayApafa";> </p>
			        </div>

			        <div class="compLastPayAPAFADivs">
			        	<label><strong>Nombre y Apellido Estudiante:</strong></label>
			        	<p id="CompLastPayAPAFANameE"; class="contenidoLastayApafa";> </p>
			    	</div>

		            <div class="compLastPayAPAFADivsSDF">
		            	<div class="compLastPayAPAFADivsSDFD">
			            	<label><strong>Grado:</strong></label>
			            	<p id="CompLastPayAPAFAGrade"; class="contenidoLastayApafa";></p>
			            </div>
		            	<div class="compLastPayAPAFADivsSDFD">
			            	<label><strong>Sección:</strong></label>
			            	<p id="CompLastPayAPAFASection"; class="contenidoLastayApafa";> </p>
			            </div>

		            	<div class="compLastPayAPAFADivsSDFD">
		            		<label><strong>Fecha y Hora:</strong></label>
		            		<p id="CompLastPayAPAFAFecha"; class="contenidoLastayApafa";> </p>
		            	</div>
		        	</div>
		   </div>
		</div>


	<?php } ?>
