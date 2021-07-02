
  <div class="modal">
        <form id="formulario_apoderado" class="box_form">
              <div style="padding:10px 10px;">

                 <button id="button_close_material" class="btn_close"><i style="font-size: 20px;" class="fas fa-times"></i></button>



      <header><h2 class="title_form">Actualizados datos del Apoderado</h2></header>

            <div  style="display:flex;width:100%;" class="form-group">
                <div style="width:50%;">
                  <label class= label_group>Nombres:</label>
                  <input type="text" id="nombre" name="nombre" class="input_txt_50" placeholder="Escriba su nombres aquí" maxlength="15" required>
                </div>

                <div style="width:50%;">
                  <label class= label_group> Apellidos:</label>
                  <input type="text" id="apellido"  name="apellido" class="input_txt_50" placeholder="Escriba su apellidos aquí" maxlength="15" required>
                </div>

                 </div>

                <div class="form-group">
                    <label class= label_group>Dni:</label>
                  <input type="text" id="dni"  name="dni" class="input_txt" placeholder="Escriba su dni aquí" required maxlength="8">
                </div>

                  <div class="form-group">
                    <label class="label_group">Teléfono:</label>
                  <input type="text" id="telefono"  name="telefono" class="input_txt" placeholder="Escriba su celular aquí"  maxlength="9" required>
                  </div>

            <div style="display:flex;margin-top:15px;">
        <button type="button" style="background: var(--danger)" id="button_close_material" class="btn_box">Cancelar</button>
         <button type="button" style="background: var(--primary)" id="btn_update_apoderado" class="btn_box">Actualizar</button>
      </div>


              </div>
         </form>
  </div>

  <div class="cont_Table ">
        <table class="table-general" id="response_table_apoderado">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre y Apellido</th>
                    <th>Estado de Pago</th>
                    <th>Telefono</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody >
            </tbody>
        </table>
    </div>
