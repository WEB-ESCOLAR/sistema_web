<?php 
  
  if(isset($_POST["logout"])){
    session_destroy();
    header("Location:Login");
  }
  $modulos=["Inicio","Materiales","Alumnos","Apoderados","ControlDeLibros"];
  // echo $_SESSION["newsession"];
 ?>
 <body>
     <div class="sidebar">
  <center>
    <img src="https://res.cloudinary.com/df3uvqrte/image/upload/v1619064442/image_user_bml1ps.png"></img>
    </center>
  <ul>
 <?php 
    foreach ($modulos as $value) { 
     echo "<li><a href=".$value."><i class='fas fa-home' ></i>".$value."</a></li>";
    }
  ?> 
  </ul>
</div>
<div class="contenido open">
  <nav class="navar">
    <div class="bar" style="display:flex;justify-content: space-between;">
      <span class="fas fa-bars"></span>
    </div>
    <!-- <p>USER</p> -->
    <!-- <p>Logout</p> -->
  </nav>
    <div class="container">
      <div class="header-container">
           <p class="title-header"><?php echo $_GET["view"]; ?></p> 
          <hr class="line-hr"/>
     </div>
      <div class="body-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
          <button name="logout">Logout</button>
        </form>
           <?php   
           if($_GET["view"] == "Home"){
              require_once 'Inicio.php';
           }
           if(isset($_GET["view"])){
              require_once $_GET["view"].'.php';
          }
         ?>        
      </div>
    </div>
  </div>
</body>