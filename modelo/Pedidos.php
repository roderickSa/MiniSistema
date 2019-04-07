<?php

require_once '../config/conexion.php';

class Pedido extends Conexion{

public function buscaNombre($nombres){

    $sql='select id,nombres,apellidos,dni,correo from clientes 
          where nombres like "'.$nombres.'%" and estado="ACTIVO"';
    $sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
}

public function registrarPedido($cliente_id){

	$hoy=new DateTime('now');

    $sql='insert into pedidos(fecha_pedido,cliente_id,estado) values(:fecha_pedido,:cliente_id,"B")';
    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(":fecha_pedido",$hoy->format("Y-m-d"));
    $sql->bindValue(":cliente_id",$cliente_id);
    $resul=$sql->execute();

    if($resul>0){
        return "Registro insertado correctamente";
    }else{
    	return "Error al insertar";
    }
}

public function getPedido($cliente_id){

    $sql='select id from pedidos where cliente_id=:cliente_id and estado="B" limit 1';
    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(":cliente_id",$cliente_id);
    $sql->execute();
    $resul=$sql->fetchAll();

    if(count($resul)>0){
       
       return $resul;
    }else{
    	return "Pedido no encontrado";
    }
}

public function updateEstadoPedido($cliente_id){

    $sql='update pedidos set estado="A" where cliente_id=:cliente_id and estado="B" limit 1';
    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(":cliente_id",$cliente_id);
    $sql->execute();
    $resul=$sql->fetchAll();

    if(count($resul)>0){
       
       return $resul;
    }else{
    	return "Pedido no encontrado";
    }
}

public function buscaProducto($producto){

    $sql='select p.id,p.nombre,p.precio,p.stock,cp.nombre as categoria 
         from productos p inner join categorias_productos cp
         on p.id_categoria=cp.id where p.nombre like "'.$producto.'%" ';
    $sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
}

public function registrarPedidoDetalle($cantidad,$total,$id_pedido,$id_producto){

    $sql='insert into pedido_detalle(cantidad,total,id_pedido,id_producto) 
          values(:cantidad,:total,:id_pedido,:id_producto)';
    $sql=$this->getConnection()->prepare($sql);
	    $sql->bindValue(":cantidad",$cantidad);
	    $sql->bindValue(":total",$total);
	    $sql->bindValue(":id_pedido",$id_pedido);
	    $sql->bindValue(":id_producto",$id_producto);
    $resul=$sql->execute();

    if($resul>0){
        return "Registro Pedido_detalle insertado correctamente";
    }else{
    	return "Error al insertar";
    }
}

}
/*
$pedido=new Pedido();
var_dump($pedido->buscaProducto('c'));
*/
?>