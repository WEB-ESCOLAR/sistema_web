

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
									 <th>CODIGO</th>
									 <th>ESTADO</th>
									 <th>ACCIONES</th>
							 </tr>
					 </thead>
					 <tbody id="data_detalleMaterial_table">

					 </tbody>
			 </table>
	 </div>
