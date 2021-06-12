

	<?php if($_SESSION["rol"] == "director"){?>

		<p class="saludoMundo">hola mundo</p>
<!-- 
		<div style="margin:auto;">
		<div style="display:flex;justify-content: space-between;">
			<div style="width:45%">
				<canvas id="myChart" width="300" height="150"></canvas>
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>
			<div style="background: dodgerblue;width:100%;height:250px;margin-top:20px;">
					
			</div>
		<div style="display:flex;justify-content: space-between;margin-top:20px;">
			<div style="background: yellow;width:45%;height:280px;">
				
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>


		</div> -->
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

			<h3>Director</h3>
		
			<?php date_default_timezone_set('America/Lima');?>
	<?php }else{ ?>
		<div style="margin:auto;">
			<div style="display:flex;justify-content: space-between;">
			<div style="background: yellow;width:45%;height:280px;">
			
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>
			<!-- div style="background: dodgerblue;width:100%;height:250px;margin-top:20px;">
					
			</div> -->
		</div>
 
		<div class="ComponentLastPayAPAFA">
          <h2 class=titleLastPayApafa>Detalle ultimo Pago Apafa Generado:</h2>			      
          	<div>
	            <div >
	            <label>Nombre y Apellido Apoderado:</label>
	            <p id="CompLastPayAPAFANameA"></p>	 
	            </div>
	            <div>
	              <label>Nombre y Apellido Estudiante:</label>
	              <p id="CompLastPayAPAFANameE"></p>
	            </div>
                <div>
                  <label>Grado:</label>
                  <p id="CompLastPayAPAFAGrade"></p>
                </div>
                <div>
                  <label>Sección:</label>
                  <p id="CompLastPayAPAFASection"></p>
                <div>
                  <label>Fecha y Hora:</label>
                  <p id="CompLastPayAPAFAFecha"></p>
                </div>
                </div>
			    </div>
		</div>
 
	<?php } ?>
