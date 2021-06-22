<?php




	$typeDatase="PR";
	if($typeDatase == "PROD"){
 	    DEFINE("HOST","31.170.166.146");
	     DEFINE("USER","u994122482_dash");
	    DEFINE("PASSWORD","Dash166Escolar");
	     DEFINE("PORT","3306");
	     DEFINE("DATABASE","u994122482_web_escolar");
	 }else{
		DEFINE("HOST","localhost");
	    DEFINE("USER","root");
	    DEFINE("PASSWORD","1234");
	    DEFINE("PORT","3306");
	    DEFINE("DATABASE","base_escolar");
	}

?>
