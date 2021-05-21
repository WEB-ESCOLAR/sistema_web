<?php 

  if(isset($_POST["close_session"])){
      session_destroy();
      header("Location:index.php");
  }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 		<button name="close_session">Cerrar Session</button>
 	</form>
 </body>
 </html>