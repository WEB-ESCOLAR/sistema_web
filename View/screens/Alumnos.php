<div class="card_search">
         <div style="display:flex;width:100%;" class="form-group">
        <div style="width:50%;">
              <label class="label_group">Grado </label>
                <select  id="search_grade_student" class="input_txt_50">
                 <option  value="null" >Seleccione el grado</option>
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
                <option value="null">Seleccione la seccion</option>
                  <option value="A">A</option>
                   <option value="B">B</option>
           </select>
      </div>
      <button class="button_search" id="search_student">Buscar</button>
       <button class="button_search" style="margin-left:10px;" id="refresh_student">Refrescar</button>
      </div>
      <div class="total_filter">
          <p>Total de Alumnos Por Aula y Seccion: <span id="totalStudentsforGradeandSection">0</span></p>

      </div>
  </div>

<button type="button" class="btn_add_data" id="button_alumno"><i class="fas fa-plus-circle fa-lg"></i>Agregar Alumnos</button>

    <div class="modal">
      <form  id="formulario_alumno" class="box_form" style="display: none;">
        <div style="padding:10px 10px;">
          <button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>
          <h2 class="title_form" id="titulo_Estudiante">Registrar Alumno</h2>
          <h2 class="title_form" id="titulo_EditarEstudiante">Editar Alumno</h2>
          <div style="display:flex;width:100%;" class="form-group">
            <div style="width:50%;">
              <label class="label_group" >Nombres del estudiante</label>
              <input id="nombreEstudiante" name="Nombre" type="text" class="input_txt_50" placeholder="Ingrese el nombre">
            </div>
            <div style="width: 50%;">
              <label class="label_group" >Apellidos del estudiante</label>
              <input id="apellidoEstudiante"  name="Apellido" type="text" class="input_txt_50" placeholder="Ingrese el apellido">
            </div>
          </div>
          <div class="form-group">
            <label class="label_group">Dni del Alumno</label>
            <input  id="DniEstudiante" name="DNI"type="text" class="input_txt" placeholder="Ingrese el dni del alumno aqui..."
            maxlength="8"  required></p>
          </div>
          <div style="display:flex;width:100%;" class="form-group">
            <div style="width:50%;">
              <label class="label_group">Grado </label>
                <select  value="Primer" id="gradoEstudiante" name="Grado" class="input_txt_50">
                  <option value="Seleccione el grado">Seleccione el grado</option>
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
                  <select  value="A" id="seccionEstudiante" name="Seccion" class="input_txt_50">
                      <option  value="Seleccione la seccion">Seleccione la seccion</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                  </select>
            </div>
          </div>
      </form>
      <div id="form-apoderado">

      <div style="display:flex;" class="form-group">
      <div class="form-group">
            <label class="label_group">Dni del Apoderado</label>
            <input  id="DniApoderado" name="dni" type="text" class="input_txt" placeholder="Ingrese el dni del apoderado aqui..." maxlength="8" ></p>
        </div>

        <div style="align-self:center;margin-top:30px;display:flex;">

            <button class="btn-search" id="search_dni">
            <i class="fas fa-search"></i>
            Buscar DNI</button>
        </div>
      </div>

        <div style="display:flex;width:100%;" class="form-group">
          <div style="width:50%;">
                <label class="label_group">Nombres del Apoderado</label>
                <input  id="nombreApoderado" name="nombre" type="text" class="input_txt_50" placeholder="Ingrese el nombre" required>
          </div>
          <div style="width: 50%;">
            <label class="label_group">Apellidos del Apoderado</label>
            <input  id="apellidoApoderado" name="apellido" type="text" class="input_txt_50" placeholder="Ingrese el apellido" required>
          </div>
        </div>

        <div class="form-group">
              <label class="label_group">Telefono del apoderado</label>
              <input  id="telefonoApoderado" name="celular" type="text" class="input_txt" placeholder="Ingrese el telefono del apoderado aqui..." maxlength="8" ></p>
        </div>
      </div>

      <div style="display:flex;margin-top:15px;">
        <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Cancelar</button>
        <button type="button" style="background: var(--primary)" id="agregar_Estudiante" class="btn_box">Registrar</button>
        <button type="button" style="background: var(--primary)" id="modificar_Estudiante" class="btn_box">Guardar</button>
      </div>
    </div>

      <form id="formVerApoderado" class="verform-apoderado" style="display:flex; justify-content: space-between;">
        <h2 class="title_form" id="titulo_MostrarApoderado" style="position:relative;top:20px;left:50px;">Datos de su Apoderado</h2>
        <button id="button_close_apoderado" class="btn_closeApoderado"><i style="font-size: 20px;" class="fas fa-times"></i></button>

        <div class="form-groupApoderado" style="position:absolute;top:70px;left:15px;">
          <label>Nombre:</label>
          <p id="VernombreApoderado" style="position:relative;bottom:29px;left:100px;"></p>
        </div>
        <div class="form-groupApoderado" style="position:absolute;top:120px;left:15px;">
          <label>Apellido:</label>
          <p id="verapellidoApoderado" style="position:relative;bottom:29px;left:100px;"></p>
        </div>
        <div class="form-groupApoderado" style="position:absolute;top:170px;left:15px;">
          <label>N° DNI:</label>
          <p id="verDniApoderado" style="position:relative;bottom:29px;left:100px;"></p>
        </div>
        <div class="form-groupApoderado" style="position:absolute;top:220px;left:15px;">
          <label>Telefono:</label>
          <p id="vertelefonoApoderado" style="position:relative;bottom:29px;left:100px;"></p>
        </div>
      </form>

</div>
   <div class="cont_Table">
        <table class="table-general" id="response_table_alumnos">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                      <th>Grado</th>
                    <th>Seccion</th>
                    <th>ACCIONE</th>

                </tr> 
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script> -->
<script >
$(document).ready(function() {
    // $('#response_table_alumnos').DataTable({
    //   responsive:true,
    //   autoWidth:false,
    // });
  });

</script>
<!-- <th>Grado</th>
                    <th>Seccion</th>
                    <th>ACCIONE</th> -->

