 <?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST["email"];
  $password = $_POST["password"];
  $_SESSION["newsession"]=$user;
  header("Location:index.php?view=Home");

}



  ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FormularioLogin</title>
  </head>
  <body>
    <div class="fondo">
      <div class = "Login-box">
        <img  class="avatar" src = "https://res.cloudinary.com/df3uvqrte/image/upload/v1619064442/image_user_bml1ps.png" alt = "Logo de User">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" placeholder="Ingrese su Usuario"  name="email" class="user" style="text-align:center;" id="user">
      
      <input type="password" placeholder="Ingrese su Contraseña" name="password" class="contra" style="text-align:center;" id="contra">
        <button type="submit" class="ingresar">
        Iniciar Sesion
        </button>
      </form>
      <a href="">Registrarse</a>
    </div>
  </div>
  </body>
</html>