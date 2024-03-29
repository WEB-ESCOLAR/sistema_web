	<i  id="btn_back" style="cursor: pointer;font-size: 21px;" class="fas fa-chevron-left"><span class="textBack" style="margin-left: 10px;">Retroceder</span></i>


<div class="check-estado" style="padding:10px;margin-top: 10px;">
	<p>Filtrar Por:</p>
 <label class="checkFilter"> <input class="checkBoxFilter" type="checkbox" id="checkDisponible"> Disponibles</label>
   <label  class="checkFilter"> <input class="checkBoxFilter"  type="checkbox" id="checkPrestado"> Prestado</label>
   <label  class="checkFilter"> <input  class="checkBoxFilter" type="checkbox" id="checkDevolucion"> Devolucion</label>
	 <label  class="checkFilter"> <input  class="checkBoxFilter" type="checkbox" id="checkDanados"> Dañados</label>
</div>


 <div style="display: flex; justify-content: space-between;">
 	<button type="button" class="btn_add_data" id="button_detalleMaterial"><i class="fas fa-plus-circle fa-lg"></i>Agregar</button>
		<div style="display:flex;width: 40%;justify-content: space-around;position:relative;left:110px;">
		<button type="button" class="btn_add_data" id="btn-document" disabled><i style="margin-left:8px;margin-right: 5px;" class="fas fa-file-pdf"></i>Generar Documento</button>
		</div>
 </div>


<div class="modal_agregar_cantidad">

 <form id="formulario_detalleMaterial" style="display:none;" class="box_form">
   <div style="padding:10px 10px;">


<button id="buttonCloseDetalleMaterial" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
   <header><h2 class="title_form">Registrar Cantidad de libros</h2></header>

   <div style="width:100%;">
      <label class="label_group">  Cantidad:  </label>
   <input id="cantidad"  type="number" class="input_txt_50" placeholder="Ingresa cantidad aquí..." required>
   </div>

   <div style="display:flex;margin-top:15px;">
  <button type="button" style="background: var(--danger)" id="buttonCloseDetalleMaterial" class="btn_box">Atras</button>
      <button type="button" style="background: var(--primary)" id="agregar_detallematerial" class="btn_box">Registrar</button>
   </div>


 </div>
  </form>
  </div>


<div class="formularioPrestamo">
<form  style="padding:10px 10px;" class="form_administrarMat" id="formularioPrestamo">

		<div style="margin-top:8px;margin-left:10px">
	    <h2 class="title_form">Entrega Libro</h2>
    </div>
      <div class="closeEstudiante">
				<button id="button_close_prestamo" class="btn_close">
				<i style="font-size: 20px;" class="fas fa-times"></i></button>
      </div>
  <div style="margin-top:20px;margin-left:10px">
        <div class="dniEstudiante">
         <label  class="label_group">  DNI del Alumno:  </label> <br>
          <input style="width: 200px" id="DNI" class="input_txt" type="text" placeholder="&nbsp;Ingresa Dni aquí..." maxlength="8">
          </div>

        <div class="buscarEstudiante">
            <button id="buscarEstudiante"> <i class="fa fa-search fa-lg"></i>&nbsp;&nbsp;Buscar</button>
        </div>
				<div style="display:flex;width:100%;" class="form-group">
					<div style="width:50%;">
						<label class="label_group">Nombre:</label>
							<input style="background: rgba(0, 0, 0, 0.1)"   id="nombreEstudiante" type="text" class="input_txt_50" disabled>
				</div>
					<div style="width: 50%;">
				<label class="label_group" >Apellido:</label>
						<input style="background: rgba(0, 0, 0, 0.1)" id="apellidoEstudiante" type="text" class="input_txt_50" disabled>
					</div>
				</div>

				<div style="display:flex;width:100%;" class="form-group">
					<div style="width:50%;">
						<label class="label_group">Grado:</label>
							<input style="background: rgba(0, 0, 0, 0.1)" id="gradoEstudiante" type="text" class="input_txt_50" disabled >
				</div>
					<div style="width: 50%;">
				<label class="label_group" >Seccion:</label>
						<input style="background: rgba(0, 0, 0, 0.1)"; id="seccionEstudiante" type="text" class="input_txt_50" disabled>
					</div>
				</div>
</div>

    <div style="display:flex;margin-top:12px" class="atrasFormularioPrestamo">
      <button type="button" style="background: var(--danger)" id=atras_Libro class="btn_box">Atras</button>
      <div class="entregarFormularioPrestamo">
      <input type="submit" style="background:var(--primary);" id="btn_entregarLibro" class="btn_box" value="Entregar">
      </div>

	</div>
	</form>
</div>


<div class="formularioDevolucion">
	<form style="padding:10px 10px;" class="form_administrarMat" id="formulario_devolucion">
		<div style="margin-top:18px;margin-left:10px">
			<h2 class="title_form">Devolución</h2>
		      </div>
		        <div class="closeDevolucion">
		        <button class="btn_close" id="button_close_devolucion" >
				<i style="font-size:25px;margin-left:5px;" class="fas fa-times fa-lg"></i></button>
		          </div>
							<div class="form-group">
						<label class="label_group"> Seleccione el motivo:  </label>
						<select id="tipoMotivo"  class="input_txt" required>
				         <option value="Seleccione el grado">Seleccione el Motivo</option>
								 <option value="Fin de año">Fin de Año</option>
				         <option value="Dañado">Dañado</option>
				    <option value="Otros">Otros</option>
					</select><br>
					</div>
						<div  id="box_area_motivo" class="form-group">
							<label  class="label_group">Motivo</label>
								<div class="label_group">
								<textarea class="textarea"  id="motivo"></textarea>
								</div>
						</div>
          <div style="display:flex; margin-top:15px;">
		       <button type="button" style="background: var(--danger)" class="btn_box" id="idEstuAtras">Atras</button>
		      <input type="submit" style="background: var(--primary)" class="btn_box"  id="btn_devolverLibro" value="Guardar">
		      </div>
	</form>
</div>

<!-- 
<div class="verMotivo">
	<form style="height:245px" class="form_administrarMat" id="formulario_ver_motivo">
		<div style="margin-top:25px;margin-left:10px">
			<h2 class="title_form">Motivo</h2>
					</div>

	      <div class="closeMotivo">
	        <button class="btn_close" id="button_close_motivo" ><i class="fas fa-times fa-lg"></i></button>
	          </div>
	      <div style="margin-top:-50px" class="label_group">
	      <textarea class="textarea"  id="vermotivo" readonly></textarea>
	        </div>
	    </form>
</div> -->


<div class="verMotivo">
	<form class="box_form"  id="formulario_ver_motivo">
		<div class="form-groupApoderado" style="position:relative;top:10px;left:15px;" >
			<label class="label_group">ASUNTO :</label>
			<label  id="VerAsunto" ></label>
		</div>
		<!-- <div style="margin-left:10px">
			<h1 class="title_form">Motivo</h1>
					</div> -->
	      <div class="closeMotivo">
	        <button class="btn_close" id="button_close_motivo" ><i class="fas fa-times fa-lg"></i></button>
	       </div>
				 <div  style="padding:10px" id="box_area_motivo" class="form-group">
						<label id="MotivoLabel" style="margin-left:15px;" class="label_group">Motivo</label>
							<div id="MotivoDiv"class="label_group">
							<textarea class="textarea"  id="vermotivo"></textarea>
							</div>
					</div>
	      <!-- <div  class="label_group">
	      <textarea class="textarea"  id="vermotivo" readonly></textarea>
	        </div> -->
	    </form>
</div>



<div class="modalAgregarCantid">
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



<!-- <div class="check-estado" style="padding:10px;">
 <label> <input type="checkbox" id="checkDisponible" class="check_estado">Disponibles</label>
   <label> <input type="checkbox" id="checkPrestado" class="check_estado">Prestado</label>
   <label> <input type="checkbox" id="checkDevolucion" class="check_estado"> Devolucion</label>
</div>
 -->

	 <!-- <p id="mensaje"></p> -->



<div class="cont_Table">

			 <div id="tableFilter">

			 </div>

	 </div>
	 
	 

<!-- <div style="width:100%;margin-top: 20px;" id="rowsEmptyMessage">
		<span class="rowsEmpty">No hay Registros Aun!!</span>
	</div> -->
