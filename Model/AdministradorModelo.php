<?php 
	require_once("../core/database.php");
	class AdministrarModelo{

		public function getConexion(){
		$url = "mysql:host=".HOST.";dbname=".DATABASE.";port=".PORT;
		$con = new PDO($url,USER,PASSWORD);
		$con->query("set names utf8");
			// if($con){
			// 	echo 'conexion establecida';
			// }else{
			// 	echo 'problema de conexion';
			// }
			return $con;
		}

		public function consulta($sql){
			$response = $this->getConexion()->prepare($sql);
			$response->execute();
			return $response;
		}

	}
 ?>