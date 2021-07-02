
  <form id="configuracionUsuario" action="" method="post">
  <div class="box_items" >
    
    <div style="display:flex">
      <div class="config_group">
        <label>Nombre</label>
        <input  type="text" class="input_txt_config" id="firstName" 
        value='<?php echo (isset($_SESSION["nombre"])) ?  $_SESSION["nombre"]  : "" ?>'  
               placeholder="Ingrese el nombre" name="firstName" required>
      </div>
      <div class="config_group">
      
        <label>Apellidos</label>
        <input type="text" class="input_txt_config"  id="lastName"
        value='<?php echo (isset($_SESSION["apellido"])) ?  $_SESSION["apellido"]  : "" ?>' 

         placeholder="Ingrese el apellido"name="lastName" required >
      
      </div>
    </div>
    
    <div style="display:flex">
      <div class="config_group">
        <p><label>Email</label>
        <p><input type="email" class="input_txt_config"  id="email"
          value='<?php echo (isset($_SESSION["email"])) ?  $_SESSION["email"]  : "" ?>' 
          placeholder="Ingrese correo electronico" name="email" required></p>
      </div>
    </div>
   
    
    <div style="display:flex">
      <div class="config_group">
      
        <label>Contraseña</label>
        <input id="password" type="password" class="input_txt_config"
         placeholder="Ingrese la contraseña" name="password">
		    <i id="show-hide1" action="hide" class="fas fa-eye"></i>
      </div>
     
      <div class="config_group">
        <label>Repetir contraseña</label>
        <input id="contraseña2" name="contraseña2" type="password" class="input_txt_config" 
        placeholder="Repita la contraseña" required>
		    <i id="show-hide2" action="hide" class="fas fa-eye"></i>
      </div>
    </div>
      <div class="box_button_update_config">
         <button id="button_Configuracion" type="submit" class="btn_send">Actualizar Datos</button>
      </div>
  </div>
  </form>