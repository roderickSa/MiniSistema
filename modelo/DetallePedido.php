<?php

require_once "../config/conexion.php";

class DetallePedido extends Conexion{

	public function getAll(){

	$sql="select pd.id as id,p.id as id_pedido,c.nombres,c.apellidos,pd.cantidad,pd.total,p.fecha_pedido,pd.id_producto from 
	     pedidos p inner join clientes c on c.id=p.cliente_id
                   inner join pedido_detalle as pd on p.id=pd.id_pedido order by p.fecha_pedido desc";

    $sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
  }

  public function getAllPedido(){

	$sql="select p.id,c.nombres,c.apellidos,p.fecha_pedido from pedidos p INNER join clientes c on 
	      p.cliente_id=c.id order by p.fecha_pedido desc";

    $sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
  }

  public function getPedidoDetalle($id){

	$sql="select c.nombres,c.apellidos,pd.cantidad,pd.total from 
	     pedidos p inner join clientes c on c.id=p.cliente_id
                   inner join pedido_detalle as pd on p.id=pd.id_pedido where pd.id=:id";

    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(":id",$id);
    $sql->execute();

    return $sql->fetchAll();
  }

  public function cantidadPedido_detalle(){

  	$sql="select count(*) as cantidad from pedido_detalle";
  	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();

  }

  public function cantidadPedidos(){

  	$sql="select count(*) as cantidad from pedidos";
  	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();

  }

  public function paginacionPedido_detalle($desde,$registros){

  	$sql="select pd.id as id,p.id as id_pedido,c.nombres,c.apellidos,pd.cantidad,pd.total,p.fecha_pedido,pd.id_producto from 
	     pedidos p inner join clientes c on c.id=p.cliente_id
                   inner join pedido_detalle as pd on p.id=pd.id_pedido 
                   order by p.fecha_pedido desc
                    limit {$desde},{$registros}";
  	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();

  }

  public function paginacionPedidos($desde,$registros){

  	$sql="select p.id,c.nombres,c.apellidos,p.fecha_pedido from pedidos p INNER join clientes c on 
	      p.cliente_id=c.id order by p.fecha_pedido desc
                    limit {$desde},{$registros}";
  	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();

  }

  public function getProductosFromIdPedido($id){

	$sql="select 
	p.id as id_pedido,pd.id as id_pedido_detalle,pd.cantidad,pd.total,pr.nombre as producto,pr.precio
			from pedido_detalle pd 
			INNER join pedidos p on pd.id_pedido=p.id
			INNER join productos pr on pr.id=pd.id_producto
			where p.id=:id
			order by p.id desc";

	$sql=$this->getConnection()->prepare($sql);
	$sql->bindValue(":id",$id);
    $sql->execute();

    return $sql->fetchAll();
}

  public function getIdProducto($id){

	$sql="select p.nombre,p.precio,cp.nombre as categoria
          from productos p inner join categorias_productos cp on p.id_categoria=cp.id
          where p.id=:id";

	$sql=$this->getConnection()->prepare($sql);
	$sql->bindValue(":id",$id);
    $sql->execute();

    return $sql->fetchAll();
}

public function getTotalProductosFromIdPedido($id){

	$sql="select SUM(pd.total) as total
			from pedido_detalle pd 
			INNER join pedidos p on pd.id_pedido=p.id
			INNER join productos pr on pr.id=pd.id_producto
			where p.id=:id";

	$sql=$this->getConnection()->prepare($sql);
	$sql->bindValue(":id",$id);
    $sql->execute();

    return $sql->fetchAll();
}

}
/*
$Detalle=new DetallePedido();

var_dump($Detalle->paginacionPedido_detalle(3,4));
*/
?>