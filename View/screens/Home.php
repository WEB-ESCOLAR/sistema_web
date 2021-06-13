<?php 
  
  if(isset($_POST["logout"])){
    session_destroy();
    header("Location:Login");
  }
 
  // if(isset(explode("/",$_SERVER["REQUEST_URI"])[3])){
    // $idData;
    // if(isset(explode("/",$_SERVER["REQUEST_URI"])[3])){
    //   $idData = $id;
    // }
    $data =  explode("/",$_SERVER["REQUEST_URI"]);
    // echo count($data);
    // $id = explode("/",$_SERVER["REQUEST_URI"])[3];
    // echo URL;
  // }
  
  // $splitData = explode("?",$_GET["view"])[0];
  // echo $id;

  // "Inicio","Materiales","Alumnos","Apoderados","ControlDeLibros"
  $modulos=[
    ["name"=>"Inicio","icon"=>"fa fa-home"],
    ["name"=>"GestionDeMateriales","icon"=>"fa fa-book"],
    ["name"=>"Alumnos","icon"=>"fa fa-user-graduate"],
    ["name"=>"Apoderados","icon"=>"fa fa-user-tie"],
    ["name"=>"ControlDeMaterial","icon"=>"fa fa-book"],
    ["name"=>"Configuracion","icon"=>"fas fa-cog"]
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
     echo "<li><a href=".URL.'/'.$value["name"]." ><i class='{$value["icon"]}' ></i>".$value["name"]."</a></li>";
    }
  ?> 
  </ul>
</div>
<div class="contenido open" id="content_sidebar">
  <nav class="navar">
      <div class="bar" >
      <span class="fas fa-bars"></span>
    </div>
    <div class="logout">
      <p class="menu_link_logout"><?= strtoupper($_SESSION["rol"]);  ?></p>
      <p class="menu_link_logout" id="logoutUser" style="cursor: pointer;">Logout</p>
        <!-- <li><a style=""href="#">LOGOUT</a></li> -->
    </div> 
  </nav>
    <div class="container">
          <div class="header-container">
           <p class="title-header"><?= explode("/",$_GET["view"])[0]; ?></p> 
          <hr class="line-hr"/>
     </div>
      <div class="body-container">
           <?php   
           if($_GET["view"] == "Home"){
              require_once 'Inicio.php';
           }
           // elseif($_GET["view"] == "DetalleMateriales/".$idData){
           //    require_once 'DetalleMateriales.php';
           // }
            elseif(count($data) == 4 ){
              require_once 'AdministrarMateriales.php';
           }
           elseif(isset($_GET["view"])){
              require_once $_GET["view"].'.php';
          }
         ?>        
      </div>
        </div>
  </div>
</body>