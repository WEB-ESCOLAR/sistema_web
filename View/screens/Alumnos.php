

<button type="button" class="btn_add_data" id="button_alumno"><i class="fas fa-plus-circle fa-lg"></i>Agregar Alumnos</button>

     <div class="modal">
    <form  id="formulario_alumno" class="box_form" style="display: none;">
        <div style="padding:10px 10px;">

    <button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
      <h2 class="title_form">Registrar Alumno</h2>

      <div>

      </div>

    <div style="display:flex;width:100%;" class="form-group">
      <div style="width:50%;">
      <label class="label_group">Nombres del estudiante</label>
      <input  type="text" class="input_txt_50" placeholder="Ingrese el nombre">
        </div>

      <div style="width: 50%;">
      <label class="label_group" >Apellidos del estudiante</label>
      <input  type="text" class="input_txt_50" placeholder="Ingrese el apellido">
        </div>
      </div>

      <div class="form-group">  
        <label class="label_group">Dni del Alumno</label>
          <input type="text" class="input_txt" placeholder="Ingrese el dni del alumno aqui..."></p>
          </div>  


    <div style="display:flex;width:100%;" class="form-group">
        <div style="width:50%;">
              <label class="label_group">Grado </label> 
                <select   class="input_txt_50">
                 <option  value="Seleccione el grado">Seleccione el grado</option>
                <option  value="Primer">Primer</option>
                <option  value="Segundo">Segundo</option>
                <option  value="Tercero">Tercero</option>
                <option  value="Cuarto">Cuarto</option>
                <option  value="Quinto">Quinto</option>
                <option  value="Sexto">Sexto</option>
               </select>
        </div>
        
    <div style="width:50%;">
         <label class="label_group">Seccion</label> 
            <select  class="input_txt_50">
                <option value="Seleccione la seccion">Seleccione la seccion</option>
                  <option value="A">A</option>
                   <option value="B">B</option>
           </select>
    </div>
      </div>


  <div style="display:flex;width:100%;" class="form-group">
      <div style="width:50%;">
      <label class="label_group">Nombres del Apoderado</label>
      <input  type="text" class="input_txt_50" placeholder="Ingrese el nombre">
        </div>

      <div style="width: 50%;">
      <label class="label_group" >Apellidos del Apoderado</label>
      <input  type="text" class="input_txt_50" placeholder="Ingrese el apellido">
        </div>
      </div>

         <div class="form-group">  
        <label class="label_group">Dni del Apoderado</label>
          <input type="text" class="input_txt" placeholder="Ingrese el dni del apoderado aqui..."></p>
          </div>  

             <div class="form-group">  
        <label class="label_group">Telefono del apoderado</label>
          <input type="text" class="input_txt" placeholder="Ingrese el telefono del apoderado aqui..."></p>
          </div>  






     <div style="display:flex;margin-top:15px;">   
        <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Cancelar</button>
         <button type="button" style="background: var(--primary)" id="agregar_material" class="btn_box">Registrar</button>
      </div> 



  </div>
    </form>
</div>

 <div class="cont_Table">
        <table class="table-general">
            <thead>
                <tr>
                   <th>N°</th>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Seccion</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="response_table_alumnos">
            </tbody>
        </table>
    </div>
