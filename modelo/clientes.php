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

		$sql="insert into clientes(nombres,apellidos,dni,correo,telefono,fecha_registro,estado) 
		      values(:nombres,:apellidos,:dni,:correo,:telefono,:fecha_registro,'ACTIVO')";
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

	public function cambiarEstadoCliente($id,$estado){

		$sql="update clientes set estado=:estado where id=:id";
		$sql=$this->getConnection()->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->bindValue(":estado",$estado);
		$resul=$sql->execute();

		if($resul>0){
            return "Estado cambiado correctamente";
		}else{
			return "Error";
		}
	}

	public function estadoCliente($id){
 
       $data="";

		$sql="select estado from clientes where id=:id";
		$sql=$this->getConnection()->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->execute();

		return $sql->fetchAll();
	}
}
/*
$cli=new Cliente();
var_dump($cli->estadoCliente(2));
*/
?>