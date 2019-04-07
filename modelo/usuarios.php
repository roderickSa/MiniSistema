<?php

require_once("../config/conexion.php");

class Usuario extends Conexion{

public function login($usu,$pass){

	$sql="select * from usuarios where usuario=:usu and contraseña=:pass limit 1";

	$sql=$this->getConnection()->prepare($sql);
	$sql->bindValue(":usu",$usu);
	$sql->bindValue(":pass",$pass);
	$sql->execute();
	$resultado=$sql->fetchAll();

	if(is_array($resultado) and count($resultado)>0){

		foreach ($resultado as $row) {

			$_SESSION['id']=$row['id'];
			$_SESSION['usuario']=$row['usuario'];
			$_SESSION['tipo_usuario']=$row['tipo_usuario'];
			$_SESSION['correo']=$row['correo'];
			$_SESSION['tiempo']=time();
		}		

		header("Location:home.php");
	}else{

		return "Usuario o contraseña incorrecto o no existe";
	}
}

}


?>