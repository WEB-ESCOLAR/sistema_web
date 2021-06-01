
    <div>
   		<button style="margin-top:10px;" class="button_material">Agregar Materiales</button>
   		 <p>hola</p>
    </div>
   
    <form id="formulario_material" style="display:none;">
		<fieldset class="form">
	 <button id="button_close_material"><i class="fas fa-times"></i></button>
			<header><h2 class="title_form">Registrar Material</h2></header>
       
     <div class="form-group-material">
     	 <label>  Seleccione el Curso:  </label> 
    <select  id="curso" class="cajitas_form" required>
    <option value="Seleccione el curso">Seleccione el    Curso</option>
      <option value="Personal Social">Personal Social</option>
       <option value="Comunicacion Integral">Comunicacion Integral</option>
        <option value="Logico Matematico">Logico Matematico</option>
         <option value="Ciencia y Ambiente">Ciencia y Ambiente</option>
    </select> 
     </div> 
      
    <div class="form-group-material">
    	 <p> <label>  Seleccione el Grado:  </label> 
    <select id="grado" class="cajitas_form" required>
    <option  value="Seleccione el grado">Seleccione el    grado</option>
    <option  value="Primer">Primer</option>
    <option  value="Segundo">Segundo</option>
    <option  value="Tercero">Tercero</option>
    <option  value="Cuarto">Cuarto</option>
    <option  value="Quinto">Quinto</option>
    <option  value="Sexto">Sexto</option>
       </select> </p>
    </div>
      

   <div class="form-group-material" style="display:flex">
         <div>
         <label>Fecha de recepcion:</label> 
        <input id="fecha_recepcion" type="date" style="width:200px" class="cajitas_form" required>
      </div>

      <div>
         <label>  Cantidad:  </label> 
      <input id="cantidad"  type="text" class="cajitas_form" placeholder="Ingresa cantidad aquí..." style="width:200px" required>
      </div>  
   </div>
      
       <div class="form-group-material">
       	 <p><label>  Seleccion de Tipo de Material:  </label> 
    <select id="tipoMaterial" class="cajitas_form" required>
         <option value="Seleccione el grado">Seleccione el Grado</option>
         <option value="Libros">Libros</option>
    <option value="Otros">Otros</option>
           </select>
       </div>


      <div class="form-group-material" id="box_name_material" style="display:none;">
      	 <p><label>  Nombre del Material:  </label> 
         <input id="nombreMaterial" type="text" class="cajitas_form" placeholder="Ingresa nombre aquí..." required></p>
      </div>
      
      <div style="display:flex;margin-top:15px;">   
        <div style="background: #C42C50"class="button_form">
            <input id="button_close_material" type="button" value="Atras"                                              class="btn_send" required>           
        </div>
         <div style=" background: #003049;" class="button_form">
            <input id="agregar_material" type="submit" value="Registrar" class="btn_send" required>           
         </div>
      </div> 
        
      <!-- <div class="container"> -->
       <!-- id="resultado_json" -->
      <!-- </div>   -->
                 
		</fieldset>
	</form>



 <div class="cont_Table">
        <table class="table-general">
            <thead>
                <tr>
                   <th>N°</th>
                    <th>Nombre Curso</th>
                    <th>Tipo Material</th>
                    <th>Grado</th>
                    <th>Total Disponible</th>
                    <th>Total Inactivo</th>
                    <th>Fecha Recepcion</th>
                    <th>Cantidad Registrada</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="resultado_json">
            </tbody>
            <div id="table_text_message">
              
            </div>
        </table>
    </div>
	