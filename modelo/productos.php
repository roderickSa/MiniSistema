<?php

require_once("../config/conexion.php");

class Producto extends Conexion{

public function getAllProductos(){

	$sql="select p.*,cp.nombre as categoria
          from productos p inner join categorias_productos cp where p.id_categoria=cp.id
          ";

	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
}

public function getProducto($id){

	$sql="select p.*,cp.nombre as categoria
          from productos p inner join categorias_productos cp on p.id_categoria=cp.id
           where p.id=:id limit 1";
	$sql=$this->getConnection()->prepare($sql);

	$sql->bindValue(':id',$id);
	
	if(count($sql->execute())>0){
       return $sql->fetchAll();     

	}else {
		return  "Sin registro para valor ".$id;
	}
	
}

public function insertarProducto($nombre,$id_categoria,$precio,$stock){

    $sql="insert into productos (nombre,precio,id_categoria,stock,fecha_registro)
           values (:nombre,:precio,:id_categoria,:stock,:fecha_registro)";

    $hoy=new DateTime('now');

    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(':nombre',$nombre);
    $sql->bindValue(':precio',$precio);
    $sql->bindValue(':id_categoria',$id_categoria);
    $sql->bindValue(':stock',$stock);
    $sql->bindValue(':fecha_registro',$hoy->format('Y-m-d'));

    if($sql->execute()){
    	echo "registro insertado correctamente";
    }else{
    	echo "Error durante la insercion";
    }
}

public function actualizarProducto($id,$nombre,$precio,$id_categoria,$stock){

     $sql="update productos set 
     nombre=:nombre,precio=:precio,id_categoria=:id_categoria,stock=:stock where id=:id";

     $sql=$this->getConnection()->prepare($sql);
     $sql->bindValue(':id',$id);
     $sql->bindValue(':nombre',$nombre);
     $sql->bindValue(':precio',$precio);
     $sql->bindValue(':id_categoria',$id_categoria);
     $sql->bindValue(':stock',$stock);

     if($sql->execute()){
    	echo "registro actualizado correctamente";
    }else{
    	echo "Error durante la actualizacion";
    }
}

public function eliminarProducto($id){

     $sql="delete from productos where id=:id";

     $sql=$this->getConnection()->prepare($sql);
     $sql->bindValue(':id',$id);

     if($sql->execute()){
    	echo "registro eliminado correctamente";
    }else{
    	echo "Error durante la eliminacion";
    }
}

public function totalProductos(){

	$sql="select count(*) as total from productos";

     $sql=$this->getConnection()->prepare($sql);

     $sql->execute();

     return $sql->fetchAll();
}

public function paginacionProductos($nombre,$desde,$filasPagina){

     $sql="select p.*,cp.nombre as categoria from productos p inner join categorias_productos cp
            on p.id_categoria=cp.id
           where UPPER(p.nombre) like UPPER('%".$nombre."%') limit {$desde},{$filasPagina}
           ";
      //llama a los prodcutos con su categoria en base a la busqueda y la cantidad pedida

     $sql=$this->getConnection()->prepare($sql);

     $sql->execute();

     return $sql->fetchAll();
}

public function buscadorProductos($nombre){

	$sql="select p.*,cp.nombre as categoria from productos p inner join categorias_productos cp
            on p.id_categoria=cp.id
           where UPPER(p.nombre) like UPPER('%".$nombre."%') "; 
    //busca los productos con su categoria en base a la busqueda

	$sql=$this->getConnection()->prepare($sql);
	//$sql->bindValue(':nombre',$nombre);
	$sql->execute();

	return $sql->fetchAll();
}

public function buscadorProductosConteo($nombre){

	$sql="select count(*) as total from productos where UPPER(nombre) like UPPER('%".$nombre."%') "; 
	//cuenta los productos en base a los productos buscados

	$sql=$this->getConnection()->prepare($sql);
	//$sql->bindValue(':nombre',$nombre);
	$sql->execute();

	return $sql->fetchAll();
}

public function listadoCategorias(){

	$sql="select distinct id,nombre as categoria from categorias_productos ORDER BY nombre ASC";
	$sql=$this->getConnection()->prepare($sql);
	$sql->execute();

	return $sql->fetchAll();
}

}
/*
$pro=new Producto();
$p=$pro->getProducto(32);
var_dump($p);
*/
?>