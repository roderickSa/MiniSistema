<?php

require_once "../config/conexion.php";

class Cliente extends Conexion{

	public function getAllClientes(){

		$sql="select * from clientes";
		$sql=$this->getConnection()->prepare($sql);
		$sql->execute();

		return $sql->fetchAll();
	}

	public function getCliente($id){

		$sql="select * from clientes where id=:id";
		$sql=$this->getConnection()->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->execute();

		return $sql->fetchAll();
	}

	public function insertarCliente($nombres,$apellidos,$dni,$correo,$telefono){

		$hoy=new DateTime("now");

		$sql="insert into clientes(nombres,apellidos,dni,correo,telefono,fecha_registro) 
		      values(:nombres,:apellidos,:dni,:correo,:telefono,:fecha_registro)";
		$sql=$this->getConnection()->prepare($sql);
		
		$sql->bindValue(":nombres",$nombres);
		$sql->bindValue(":apellidos",$apellidos);
		$sql->bindValue(":dni",$dni);
		$sql->bindValue(":correo",$correo);
		$sql->bindValue(":telefono",$telefono);
		$sql->bindValue(":fecha_registro",$hoy->format("Y-m-d"));
		$resul=$sql->execute();

		if($resul>0){
            return "insertardo correctamente";
		}else{
			return "Error";
		}
	}

	public function actualizarCliente($id,$nombres,$apellidos,$dni,$correo,$telefono){

		$sql="update clientes set  
		      nombres=:nombres,apellidos=:apellidos,dni=:dni,correo=:correo,telefono=:telefono
		      where id=:id";
		$sql=$this->getConnection()->prepare($sql);
		
		$sql->bindValue(":id",$id);
		$sql->bindValue(":nombres",$nombres);
		$sql->bindValue(":apellidos",$apellidos);
		$sql->bindValue(":dni",$dni);
		$sql->bindValue(":correo",$correo);
		$sql->bindValue(":telefono",$telefono);
		$resul=$sql->execute();

		if($resul>0){
            return "Actualizado correctamente";
		}else{
			return "Error";
		}
	}

	public function eliminarCliente($id){

		$sql="delete from clientes where id=:id";
		$sql=$this->getConnection()->prepare($sql);
		$sql->bindValue(":id",$id);
		$resul=$sql->execute();

		if($resul>0){
            return "Eliminado correctamente";
		}else{
			return "Error";
		}
	}
}
/*
$cli=new Cliente();
var_dump($cli->eliminarCliente(3));
*/
?>