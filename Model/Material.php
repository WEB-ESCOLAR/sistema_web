<?php 

	class Material{
		var $id;
		var $nombreCurso;
		var $tipoMaterial;
		var $grado;
		var $fechaRecepcion;
		var $nombreMaterial;
		var $cantidad;
		function __construct($id,$nombreCurso,$tipoMaterial,$grado,$fechaRecepcion,$nombreMaterial,$cantidad){
			$this->id=$id;
			$this->nombreCurso=$nombreCurso;
			$this->tipoMaterial=$tipoMaterial;
			$this->grado=$grado;
			$this->fechaRecepcion=$fechaRecepcion;
			$this->nombreMaterial=$nombreMaterial;
			$this->cantidad=$cantidad;
		}

	}


 ?>