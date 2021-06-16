


  <div class="card_search">
         <div style="display:flex;width:100%;" class="form-group">
        <div style="width:50%;">
              <label class="label_group">Grado </label>
                <select  id="search_grade_student" class="input_txt_50">
                 <option  value="Seleccione el grado" >Seleccione el grado</option>
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
            <select  id="search_section_student" class="input_txt_50">
                <option value="Seleccione la seccion">Seleccione la seccion</option>
                  <option value="A">A</option>
                   <option value="B">B</option>
           </select>
      </div>
      <button class="button_search" id="search_student">Buscar</button>
       <button class="button_search" style="margin-left:10px;" id="search_student">Refrescar</button>
      </div>
      <div class="total_filter">
        <p>Total de Alumnos Por Aula y Seccion:<span>20</span></p>
      </div>
  </div>

<button type="button" class="btn_add_data" id="button_alumno"><i class="fas fa-plus-circle fa-lg"></i>Agregar Alumnos</button>

     <div class="modal">
    <form  id="formulario_alumno" class="box_form" style="display: none;">
          <div style="padding:10px 10px;">

          <button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
          <h2 class="title_form" id="titulo_Estudiante">Registrar Alumno</h2>
            <!-- <h2 class="title_form" id="titulo_EditarEstudiante">Editar Alumno</h2> -->

      <div style="display:flex;width:100%;" class="form-group">
            <div style="width:50%;">
            <label class="label_group" value="juan">Nombres del estudiante</label>
            <input id="nombreEstudiante" value="juan" name="Nombre" type="text" class="input_txt_50" placeholder="Ingrese el nombre">
            </div>
            <div style="width: 50%;">
            <label class="label_group" value="a">Apellidos del estudiante</label>
            <input id="apellidoEstudiante"  value="juan"name="Apellido" type="text" class="input_txt_50" placeholder="Ingrese el apellido">
            </div>
      </div>

      <div class="form-group">
          <label class="label_group" value="12345677">Dni del Alumno</label>
          <input  id="DniEstudiante" value="12345677" name="DNI"type="text" class="input_txt" placeholder="Ingrese el dni del alumno aqui..."
          maxlength="8"  required></p>
      </div>

      
      <div style="display:flex;width:100%;" class="form-group">
        <div style="width:50%;">
              <label class="label_group">Grado </label>
                <select  value="Primer" id="gradoEstudiante" name="Grado" class="input_txt_50">
                 <option  value="Seleccione el grado">Seleccione el grado</option>
                <option  value="Primer">Primer</option>
                <option  value="Segundo">Segundo</option>
                <option  value="Tercero" selected>Tercero</option>
                <option  value="Cuarto">Cuarto</option>
                <option  value="Quinto">Quinto</option>
                <option  value="Sexto">Sexto</option>
               </select>
            </div>

            <div style="width:50%;">
              <label class="label_group">Seccion</label>
                  <select  value="A" id="seccionEstudiante" name="Seccion" class="input_txt_50">
                      <option  value="Seleccione la seccion">Seleccione la seccion</option>
                        <option value="A" selected>A</option>
                        <option value="B">B</option>
                </select>
            </div>
      </div>

      <div id="form-apoderado">
      <div style="display:flex;width:100%;" class="form-group">
            <div style="width:50%;">
                <label class="label_group" value="juan">Nombres del Apoderado</label>
                <input  id="nombreApoderado" value="juan" name="nombre" type="text" class="input_txt_50" placeholder="Ingrese el nombre" required>
            </div>
            <div style="width: 50%;">
            <label class="label_group" value="juan">Apellidos del Apoderado</label>
            <input  id="apellidoApoderado" value="juan" name="apellido" type="text" class="input_txt_50" placeholder="Ingrese el apellido" required>
            </div>
      </div>
          <div class="form-group">
              <label class="label_group"value="77654321">Dni del Apoderado</label>
              <input  id="DniApoderado"  value="77654321"name="dni" type="text" class="input_txt" placeholder="Ingrese el dni del apoderado aqui..." maxlength="8" ></p>
          </div>

             <div class="form-group">
                <label class="label_group" value="333222111">Telefono del apoderado</label>
                  <input  id="telefonoApoderado" value="77654321" name="celular" type="text" class="input_txt" placeholder="Ingrese el telefono del apoderado aqui..." maxlength="8" ></p>
             </div>
    </div>




      <div style="display:flex;margin-top:15px;">
        <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Cancelar</button>
         <button type="button" style="background: var(--primary)" id="agregar_Estudiante" class="btn_box">Registrar</button>
         <button type="button" style="background: var(--primary)" id="editar_Estudiante" class="btn_box">Editar</button>
      </div>
        <!-- <button type="button" style="background: var(--primary)" id="agregar_Estudiante" class="btn_box">Registrar</button>
       
      </div>  -->
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
