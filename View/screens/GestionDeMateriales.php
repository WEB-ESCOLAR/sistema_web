   <div class="card_search">
      <div style="display:flex;width:100%;" class="form-group">
        <div style="width:50%;">
              <label class="label_group">Curso</label>
                <select  id="search_name_curse" class="input_txt_50">
                  <option  value="null" >Seleccione el nombre del curso</option>
               </select>
        </div>
        <button class="button_search" id="search_Curse">Buscar</button>
        <button class="button_search" style="margin-left:10px;" id="refresh_Curse">Refrescar</button>
      </div>
  </div>


    <!-- <div> -->
   		 <button type="button" class="btn_add_data" id="button_material"><i class="fas fa-plus-circle fa-lg"></i>Agregar Material</button>
    <!-- </div> -->
   <div class="modal">

    <form id="formulario_material" style="display:none;" class="box_form">
      <div style="padding:10px 10px;">


	 <button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
			<header><h2 class="title_form">Registrar Material</h2></header>

     <div class="form-group">
     	 <label class="label_group"> Seleccione el Curso:</label>
    <select  id="curso" class="input_txt" required>
    <option value="Seleccione el curso">Seleccion el curso</option>
    </select>
     </div>

    <div class="form-group">
    	  <label class="label_group">  Seleccione el Grado:  </label>
    <select id="grado" class="input_txt" required>
    <option  value="Seleccione el grado">Seleccione el grado</option>
    <option  value="Primer">Primer</option>
    <option  value="Segundo">Segundo</option>
    <option  value="Tercero">Tercero</option>
    <option  value="Cuarto">Cuarto</option>
    <option  value="Quinto">Quinto</option>
    <option  value="Sexto">Sexto</option>
       </select>
    </div>


   <div style="display:flex;width:100%;" class="form-group">
        <div style="width: 50%;">
         <label class="label_group">Fecha de recepcion:</label>
        <input id="fecha_recepcion" type="date" class="input_txt_50" required>
      </div>

      <div style="width:50%;">
         <label class="label_group">  Cantidad:  </label>
      <input id="cantidad"  type="text" class="input_txt_50" placeholder="Ingresa cantidad aquí..." required>
      </div>
   </div>

       <div class="form-group">
       	 <label class="label_group"> Seleccion de Tipo de Material:  </label>
    <select id="tipoMaterial" class="input_txt" required>
         <option value="Seleccione el grado">Seleccione el Tipo de Material</option>
         <option value="Libros">Libros</option>
    <option value="Otros">Otros</option>
           </select>
       </div>


      <div class="form-group" id="box_name_material" style="display:none;">
      	 <label class="label_group">  Nombre del Material:  </label>
         <input id="nombreMaterial" type="text" class="input_txt" placeholder="Ingresa nombre aquí..." required></p>
      </div>

      <div style="display:flex;margin-top:15px;">
        <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Cancelar</button>
         <button type="button" style="background: var(--primary)" id="agregar_material" class="btn_box">Registrar</button>
      </div>

          </div>
	</form>
  </div>



 <div class="cont_Table">
        <table class="table-general" id="data_materiales_table">
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
            <tbody >
            </tbody>
        </table>

    </div>
