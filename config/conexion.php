<?php

session_start();

class Conexion{

	private $host;
	private $bd;
	private $pass;
	private $user;
	private $charset;

   public function __construct(){

    $this->host="localhost";
    $this->bd="rsistema";
    $this->pass="";
    $this->user="root";
    $this->charset="utf8";
   }

   public function getConnection(){

     try {
     	
   	   $conexion='mysql:host='.$this->host.';dbname='.$this->bd.';charset='.$this->charset;
   	   $pdo=new PDO($conexion,$this->user,$this->pass);

   	   return $pdo;

     } catch (Exception $e) {
     	echo "Error: ".$e->getMessage();
     }
   }

}

?>