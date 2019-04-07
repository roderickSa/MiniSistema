<?php

require_once '../config/conexion.php';

//cada 10 min accedemos acá desde javascript cliente.js

$inactividad=600;

$visaSesion=time()-$_SESSION['tiempo'];

if(isset($_SESSION['correo']) and $visaSesion>$inactividad){

	session_unset();
	session_destroy();

	header("Location:index.php");
	exit();

}else{

	$_SESSION['tiempo']=time();
	header("Location:home.php");
}

?>