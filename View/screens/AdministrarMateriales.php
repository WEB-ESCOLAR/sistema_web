

<div class="modal_agregar_cantidad">

 <form id="formulario_detalleMaterial" style="display:none;" class="box_form">
   <div style="padding:10px 10px;">


<button id="buttonCloseDetalleMaterial" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
   <header><h2 class="title_form">Registrar Cantidad de libros</h2></header>

   <div style="width:100%;">
      <label class="label_group">  Cantidad:  </label>
   <input id="cantidad"  type="text" class="input_txt_50" placeholder="Ingresa cantidad aquí..." required>
   </div>

   <div style="display:flex;margin-top:15px;">
  <button type="button" style="background: var(--danger)" id="buttonCloseDetalleMaterial" class="btn_box">Atras</button>
      <button type="button" style="background: var(--primary)" id="agregar_detallematerial" class="btn_box">Registrar</button>
   </div>


 </div>
  </form>
  </div>


<div class="formularioPrestamo">
<form class="form-Prestamo" id="formularioPrestamo">

		<div>
	<header><h1 class="titleEstudiante">Entrega de Libro</h1></header>
      </div>
      <div class="closeEstudiante">
        <button class="btn-close" id="button_close_prestamo"><i class="fas fa-times fa-lg"></i></button>
      </div>

        <div class="dniEstudiante">
         <label>  DNI del Alumno:  </label> <br>
          <input id="DNI" class="DNI" type="text" placeholder="&nbsp;Ingresa Dni aquí...">
          </div>

        <div class="buscarEstudiante">
            <button id="buscarEstudiante"> <i class="fa fa-search fa-lg"></i>&nbsp;&nbsp;Buscar</button>
        </div>

      <div class="nombreEstudiante">
         <label>  Nombre:  </label> <br>
          <input id="nombreEstudiante" type="text" readonly>
          </div>

      <div class="apellidoEstudiante">
         <label>  Apellido:  </label> <br>
          <input id="apellidoEstudiante" type="text" readonly>
          </div>

      <div class="gradoEstudiante">
         <label>  Grado:  </label> <br>
          <input id="gradoEstudiante" type="text" readonly>
          </div>

      <div class="seccionEstudiante">
         <label>  Sección:  </label> <br>
          <input id="seccionEstudiante" type="text" readonly>
          </div>

      <div class="atrasFormularioPrestamo">
      <button class="btn-atras">Atras</button>
      </button>

      <div class="entregarFormularioPrestamo">
      <input type="submit" id="entregarLibro" class="btn-entregarLibro" value="Entregar">
      </div>

	</div>
	</form>
</div>


<div class="formularioDevolucion">
	<form class="form-Devolucion" id="formulario_devolucion">
		<div>
			<header><h1 class="titleDevolucion   ">Devolución</h1></header>
		      </div>

		        <div class="closeDevolucion">
		        <button class="btn-close" id="button_close_devolucion" ><i class="fas fa-times fa-lg"></i></button>
		          </div>

		        <div class="areaDevolucion">
		          <label>Motivo</label><br>
		          <textarea id="motivo"></textarea>
		          </div>

		        <div class="atrasDevolucion">
		      <button class="btn-atras" >Atras</button>
		          </div>

		      <div class="realizarDevolucion">
		      <input type="submit" class="btn-devolverLibro" id="devolverLibro" value="Guardar">
		      </div>
	</form>

</div>



<div class="verMotivo">
	<form class="form-Motivo" id="formulario_ver_motivo">
	      <div>
		<header><h1 class="titleMotivo">Motivo</h1></header>
	      </div>

	      <div class="closeMotivo">
	        <button class="btn-close" id="button_close_motivo" ><i class="fas fa-times fa-lg"></i></button>
	          </div>
	      <div class="areaMotivo">
	      <textarea id="vermotivo" readonly></textarea>
	        </div>
	    </form>
</div>



 <button type="button" class="btn_add_data" id="button_material"><i class="fas fa-plus-circle fa-lg"></i>Agregar Libro</button>



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




<div class="check-estado" style="padding:10px;">
 <label> <input type="checkbox" id="checkDisponible"> Disponibles</label>
   <label> <input type="checkbox" id="checkPrestado"> Prestado</label>
   <label> <input type="checkbox" id="checkDevolucion"> Devolucion</label>
</div>

	<button id="btn_back" style="margin-bottom: 10px;padding:10px;">Retroceder</button>

	 <p id="mensaje"></p>

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



</div>
