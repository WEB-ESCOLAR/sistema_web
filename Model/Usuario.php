<?php


/**
 *
 */
class Usuario
{
  var $idUser;
  var $firstName;
  var $lastName;
  var $email;
  var $password;
  var $rol;
  var $estado;
  var $fechaHoraIngreso;

  function __construct($idUser,$firstName,$lastName,$email,$password,$rol){
    $this->idUser=$idUser;
    $this->firstName=$firstName;
    $this->lastName=$lastName;
    $this->email=$email;
    $this->password=$password;
    $this->rol=$rol;
  }

  public function setEstado($estado){
    return $this->estado=$estado;
  }

  public function setFechaHoraIngreso($fechaHoraIngreso){
    return $this->fechaHoraIngreso=$fechaHoraIngreso;
  }

  public function actualizarEstadoDeSesion($estado){
    if ($estado==1) {
     $this->setEstado("on");
   }else {
     $this->setEstado("off");
   }
   $this->setFechaHoraIngreso(date("Y-m-d"),time());
}
  public function desencriptarContraseña($contraseñaIngresada){
    return password_verify($contraseñaIngresada,$this->password);
}

}



 ?>
