
  <form id="configuracionUsuario">
  <div class="box_items" >
    
    <div style="display:flex">
      <div>
        <label>Nombre</label>
        <input  type="text" class="input_txt_config" value="<?php echo $nombre = $_SESSION["nombre"];?>" placeholder="Ingrese el nombre" name="firstName" style="width:200px">
      </div>
      <div>
      
        <label>Apellidos</label>
        <input type="text" class="input_txt_config" value="<?php echo $apellido = $_SESSION["apellido"];?>" placeholder="Ingrese el apellido"name="lastName" style="width:200px" >
      
      </div>
    </div>
    
    <div style="display:flex">
      <div>
        <p><label>Email</label>
        <p><input type="text" class="input_txt_config" value="<?php echo $email = $_SESSION["email"];?>" placeholder="Ingrese correo electronico" name="email" style="width:200px"></p>
      </div>
    </div>
   
    
    <div style="display:flex">
      <div>
        <label>Contraseña</label>
        <input id="contraseña1" type="password" class="input_txt_config" placeholder="Ingrese la contraseña" name="password" style="width:200px" >
		    <i id="show-hide1" action="hide" class="fas fa-eye"></i>
      </div>
     
      <div>
        <label>Repetir contraseña</label>
        <input id="contraseña2" type="password" class="input_txt_config" placeholder="Repita la contraseña" style="width:200px">
		    <i id="show-hide2" action="hide" class="fas fa-eye"></i>
      </div>
    </div>
    <button id="button_Configuracion" type="button" class="btn_send">Actualizar Datos</button>
  </div>
  </form>