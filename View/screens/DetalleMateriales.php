
<div class="modal">
<form class="form-EL" id="formulario_prestamo">

		<div>
	<header><h1 class="title-EL">Entrega de Libro</h1></header>
      </div>
      <div class="close-EL">
        <button class="detaLibro" id="button_close_prestamo"><i class="fas fa-times fa-lg"></i></button>
      </div>

        <div class="dni-EL">
         <label>  DNI del Alumno:  </label> <br>
          <input id="DNI" class="DNI" type="text" placeholder="&nbsp;Ingresa Dni aquí...">
          </div>

        <div class="buscar-EL">
            <button id="buscar_alumno"> <i class="fa fa-search fa-lg"></i>&nbsp;&nbsp;Buscar</button>
        </div>

      <div class="nombre-EL">
         <label>  Nombre:  </label> <br>
          <input id="nombreEstu" type="text" readonly>
          </div>

      <div class="apellido-EL">
         <label>  Apellido:  </label> <br>
          <input id="apellidoEstu" type="text" readonly>
          </div>

      <div class="grado-EL">
         <label>  Grado:  </label> <br>
          <input id="gradoEstu" type="text" readonly>
          </div>

      <div class="seccion-EL">
         <label>  Sección:  </label> <br>
          <input id="seccionEstu" type="text" readonly>
          </div>

      <div class="atras-EL">
      <button class="estudiante">Atras</button>
      </button>

      <div class="entregar-EL">
      <input type="submit" id="entregarLibro" value="Entregar">
      </div>

	</div>
	</form>
</div>

<div class="modalDevolver">

	<form class="form-Devo" id="formulario_devolucion">
		<div>
			<header><h1 class="title-Devo   ">Devolución</h1></header>
		      </div>

		        <div class="close-Devo">
		        <button class="detLibro" id="button_close_devolucion" ><i class="fas fa-times fa-lg"></i></button>
		          </div>

		        <div class="area-Devo">
		          <label>Motivo</label><br>
		          <textarea id="motivo"></textarea>
		          </div>

		        <div class="atras-Devo">
		      <button>Atras</button>
		          </div>

		      <div class="entregar-Devo">
		      <input type="submit" id="devolverLibro" value="Guardar">
		      </div>
	</form>

</div>

<div class="modalVerMotivo">

	<form class="form-Moti" id="formulario_ver_motivo">
	      <div>
		<header><h1 class="title-Moti   ">Motivo</h1></header>
	      </div>

	      <div class="close-Moti">
	        <button id="button_close_motivo" ><i class="fas fa-times fa-lg"></i></button>
	          </div>
	      <div class="area-Moti">
	      <textarea id="vermotivo" readonly></textarea>
	        </div>
	    </form>

</div>
<div>
 <button type="button" class="btn_add_data" id="button_material"><i class="fas fa-plus-circle fa-lg"></i>Agregar Libro</button>
</div>
<div class="modal">

 <form id="formulario_material" style="display:none;" class="box_form">
   <div style="padding:10px 10px;">


<button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
   <header><h2 class="title_form">Registrar Cantidad de libros</h2></header>

   <div style="width:100%;">
      <label class="label_group">  Cantidad:  </label>
   <input id="cantidad"  type="text" class="input_txt_50" placeholder="Ingresa cantidad aquí..." required>
   </div>

   <div style="display:flex;margin-top:15px;">
  <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Atras</button>
      <button type="button" style="background: var(--primary)" id="agregar_detallematerial" class="btn_box">Registrar</button>
   </div>


 </div>
  </form>
  </div>



<div class="cont_Table">
			 <table class="table-general">
					 <thead>
							 <tr>
								 <th>N°</th>
									<th>Codigo</th>
									 <th>Estado</th>
									 <th>ACCIONES</th>
							 </tr>
					 </thead>
					 <tbody id="data_detalleMaterial_table">
					 </tbody>
			 </table>
	 </div>


					 </tbody>
			 </table>
	 </div>
<div>
	<button type="button" class="btn_add_data" id="button_material"><i class="fas fa-plus-circle fa-lg"></i>Agregar Libro</button>
</div>
<div class="modal">
	<form id="formulario_material" style="display:none;" class="box_form">
		<div style="padding:10px 10px;">
			<button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
			<header><h2 class="title_form">Registrar Cantidad de libros</h2></header>
			<div style="width:100%;">
     				<label class="label_group">  Cantidad:  </label>
   					<input id="cantidad"  type="text" class="input_txt_50" placeholder="Ingresa cantidad aquí..." required>
			 </div>
			<div style="display:flex;margin-top:15px;">
				<button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Atras</button>
  				<button type="button" style="background: var(--primary)" id="agregar_material" class="btn_box">Registrar</button>
			</div>
	 	</div>
	</form>
</div>
<div class="check-estado" style="padding:10px;">
 <label> <input type="checkbox" id="checkDisponible"> Disponibles</label>
   <label> <input type="checkbox" id="checkPrestado"> Prestado</label>
   <label> <input type="checkbox" id="checkDevolucion"> Devolucion</label>
</div>
<div class="cont_Table">
		 <table class="table-general">
				 <thead>
					 <tr>
						<th>N°</th>
						 <th>CODIGO</th>
						 <th>ESTADO</th>
						 <th>ACCIONES</th>
					 </tr>
				 </thead>
				 <tbody id="data_detallematerial_table">
				 </tbody>
		 </table>
</div>
  <button id="btn_back" style="margin-bottom: 10px;padding:10px;">Retroceder</button>
 <p id="mensaje"></p>
