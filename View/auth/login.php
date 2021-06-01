 <?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
  $password = $_POST["password"];
  
 if($email == "secretaria@hotmail.com"){
    $_SESSION["newsession"]="Secretaria";
      header("Location:Home");
 }if($email == "docente@hotmail.com"){
   $_SESSION["newsession"]="Docente";
   header("Location:Home");
 }else{
   echo 'no existe el usuario ingresado';
 }
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
      <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="text" placeholder="Ingrese su Usuario"  name="email" class="user" style="text-align:center;" id="user">
      
      <input type="password" placeholder="Ingrese su Contraseña" name="password" class="contra" style="text-align:center;" id="contra">
        <button type="submit" class="ingresar">
        Iniciar Sesion
        </button>
      </form>
      <!-- <a href="">Registrarse</a> -->
    </div>
  </div>
  </body>
</html>