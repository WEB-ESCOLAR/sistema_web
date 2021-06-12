<?php 

	class Material{
		var $id;
		var $nombreCurso;
		var $tipoMaterial;
		var $grado;

		var $totalDisponible;
		var $totalInactivo;

		var $fechaRecepcion;
		var $nombreMaterial;
		var $cantidad;
		function __construct($id,$nombreCurso,$tipoMaterial,$grado,$totalDisponible,$totalInactivo,$fechaRecepcion,$nombreMaterial,$cantidad){
			$this->id=$id;
			$this->nombreCurso=$nombreCurso;
			$this->tipoMaterial=$tipoMaterial;
			$this->grado=$grado;

			$this->totalDisponible=$totalDisponible;
			$this->totalInactivo=$totalInactivo;

			$this->fechaRecepcion=$fechaRecepcion;
			$this->nombreMaterial=$nombreMaterial;
			$this->cantidad=$cantidad;
		}

	}


 ?>