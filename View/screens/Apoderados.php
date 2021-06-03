 
  <div class="modal">
        <form id="formulario_apoderado">
            <fieldset class="form_ADA">
              
            <div class=button_exit_X >  
                <button class="btn_exit_X"><i class="fas fa-times"></i></button>
            </div>
              <div class="title_form_ADA"><h2>Actualizar Datos del <br>Apoderado</h2></div>
              
            <div class="form_text_box">  
                <div>
                  <label class= input_label>Nombres:</label>
                  <input type="text" id="nombre" name="nombre" class="input_nom_ape" placeholder="Escriba su nombres aquí">
                </div>
                <div>
                  <label class= input_label> Apellidos:</label>
                  <input type="text" id="apellido"  name="apellido" class="input_nom_ape" placeholder="Escriba su apellidos aquí">
                </div>
                <div class="without_column">
                  <label class= input_label>Dni:</label>
                  <input type="text" id="dni"  name="dni" class="input_dni_tel"placeholder="Escriba su dni aquí">
                </div>
                <div class="without_column">
                  <label>Teléfono:</label>
                  <input type="number" id="telefono"  name="telefono" class="input_dni_tel" placeholder="Escriba su celular aquí">
                </div>
            </div>
         <div class="buttons_exit_send">
              <div class="button_behind">
                 <button type="button" class="btn_text">Volver Atrás</button>
              </div>
              <div class="button_submit_send">   
                 <button type="submit" class="btn_text" id="btn_update_apoderado">Actualizar</b>
              </div>
         </div>
            </fieldset>
         </form> 
  </div>

  <div class="cont_Table">
        <table class="table-general">
            <thead>
                <tr>
                   <th>N°</th>
                     <th>DNI</th>
                    <th>Nombre y Apellido</th>
                    <th>Estado de Pago</th>
                    <th>Telefono</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="response_table_apoderado">
            </tbody>
        </table>
    </div>