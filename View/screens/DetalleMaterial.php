 	<i  id="btn_back" style="cursor: pointer;font-size: 21px;" class="fas fa-chevron-left"><span class="textBack" style="margin-left: 10px;">Retroceder</span></i>


<div style="display: flex;justify-content: space-between;">
	<div class="check-estado" style="padding:10px;margin-top: 10px;">
	<p>Filtrar Por:</p>
 <label class="checkFilter"> <input class="checkBoxFilter" type="checkbox" id="checkDisponible"> Disponibles</label>
   <label  class="checkFilter"> <input class="checkBoxFilter"  type="checkbox" id="checkPrestado"> Prestado</label>
   <label  class="checkFilter"> <input  class="checkBoxFilter" type="checkbox" id="checkDevolucion"> Devolucion</label>
</div>


 	<div class="search_inputBox">
	 	<input type="text" placeholder="Buscar Alumno" class="search_input">
	 	<i class="fas fa-search"></i>
	 </div>
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


