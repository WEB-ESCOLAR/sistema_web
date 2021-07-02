 <?php 

// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $email = $_POST["email"];
//   $password = $_POST["password"];
  
//  if($email == "secretaria@hotmail.com"){
//     $_SESSION["newsession"]="Secretaria";
//       header("Location:Home");
//  }if($email == "docente@hotmail.com"){
//    $_SESSION["newsession"]="Docente";
//    header("Location:Home");
//  }else{
//    echo 'no existe el usuario ingresado';
//  }
// }

// echo "CRYPT " . crypt("123456");
// $hash =  password_hash("123456", PASSWORD_BCRYPT );
// $pass = "123456";
// echo 'HASH ' . $hash . "<br/>";
// if(password_verify($pass,$hash)){
//   echo 'correct';
// }



  ?>
 <section>
      <div class="imgBx">
           <?=  "<img src=".URL."/Web/img/background_colegio.jpeg> </img>"; ?>
        <!-- <img src="https://scontent.flim17-1.fna.fbcdn.net/v/t31.18172-8/21743780_1720594218245794_5836783595616387716_o.jpg?_nc_cat=107&ccb=1-3&_nc_sid=e3f864&_nc_ohc=42vL7ZOzmxAAX_S7DkH&_nc_ht=scontent.flim17-1.fna&oh=a80c3cf5feab841ee3f854ede43cbef1&oe=60D4AF7D"> -->
      </div>
      <div class="contentBx">
        <div class="formBx" >
          <form  id="formulario_login">
            <div class=logo>
             <?=  "<img src=".URL."/Web/img/logo_login.jpeg> </img>"; ?>
              </div>
            <div class="inputBx">
              <span>Email</span>
              <input type="text"  id="email" name="email" placeholder="Ingrese su Email">
              </div>
            
            <div class="inputBx">
              <span>Password</span>
              <input type="password"  id="password" name="password" placeholder="Ingrese su Contraseña">
              </div>
              <span id="message_login"></span>
            <div class="ingresar">
            <input  type="submit" value="Iniciar Session">
            </div>

            </form>
          </div>
      </div>
    </section>