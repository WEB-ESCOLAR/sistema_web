<?php 
  
  if(isset($_POST["logout"])){
    session_destroy();
    header("Location:Login");
  }
  // "Inicio","Materiales","Alumnos","Apoderados","ControlDeLibros"
  $modulos=[
    ["name"=>"Inicio","icon"=>"fa-home"],
    ["name"=>"Materiales","icon"=>"fa-book"],
    ["name"=>"Alumnos","icon"=>"fa-user-graduate"],
    ["name"=>"Apoderados","icon"=>"fa-user-tie"],
    ["name"=>"ControlDeLibros","icon"=>"fa-book"]
  ];
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
     echo "<li><a href=".$value["name"]."><i class='fa {$value["icon"]}' ></i>".$value["name"]."</a></li>";
    }
  ?> 
  </ul>
</div>
<div class="contenido open">
  <nav class="navar">
    <div class="bar" style="display:flex;justify-content: space-between;">
      <span class="fas fa-bars"></span>
    </div>
    <div class="logout">
      <li><a style=""href="#">LOGOUT</a></li>
    </div> 

  </nav>
    <div class="container">
      <div class="header-container">
           <p class="title-header"><?php echo $_GET["view"]; ?></p> 
          <hr class="line-hr"/>
     </div>
      <div class="body-container">
        <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
          <button name="logout">Logout</button>
        </form> -->
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