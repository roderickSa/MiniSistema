<?php

require_once '../config/conexion.php';

class Pedido extends Conexion{

public function buscaNombre($nombres){

    $sql='select id,nombres,apellidos,dni,correo from clientes where nombres like "'.$nombres.'%" ';
    $sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
}

}
/*
$pedido=new Pedido();
var_dump($pedido->buscaNombre("rod"));
*/
?>