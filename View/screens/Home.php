
 <body>
     <div class="sidebar">
  <center>
    <img src="https://res.cloudinary.com/df3uvqrte/image/upload/v1619064442/image_user_bml1ps.png"></img>
    </center>
  <ul>
  <li><a href="Inicio"><i class="fas fa-home" ></i>Inicio</a></li>
  <li><a href="Alumnos"><i class="fas fa-user-graduate"></i>Alumnos</a></li>
  <li><a href="Cursos"><i class="fas fa-book"></i>Cursos</a></li>
  <li><a href="Docentes"><i class="fas fa-user-tie"></i>Docentes</a></li>
  <li><a href="Notas"><i class="fas fa-clipboard-list"></i>Notas</a></li>
  <li><a href="Calendario"><i class="fas fa-calendar-alt"></i>Calendario</a></li>
  </ul>
</div>
<div class="contenido">
  <nav class="navar">
    <div class="bar">
      <span class="fas fa-bars"></span>
    </div>
  </nav>
    <div>
    <?php   
      if(isset($_GET["view"])){
          require_once $_GET["view"].'.php';
         }
     ?>
    </div>
  </div>
</body>