<?php

require_once("../config/conexion.php");

class Producto extends Conexion{

public function getAllProductos(){

	$sql="select * from productos";

	$sql=$this->getConnection()->prepare($sql);
    $sql->execute();

    return $sql->fetchAll();
}

public function getProducto($id){

	$sql="select * from productos where id=:id limit 1";
	$sql=$this->getConnection()->prepare($sql);

	$sql->bindValue(':id',$id);
	
	if(count($sql->execute())>0){
       return $sql->fetchAll();     

	}else {
		return  "Sin registro para valor ".$id;
	}
	
}

public function insertarProducto($nombre,$categoria,$precio,$stock){

    $sql="insert into productos (nombre,precio,categoria,stock,fecha_registro)
           values (:nombre,:precio,:categoria,:stock,:fecha_registro)";

    $hoy=new DateTime('now');

    $sql=$this->getConnection()->prepare($sql);
    $sql->bindValue(':nombre',$nombre);
    $sql->bindValue(':precio',$precio);
    $sql->bindValue(':categoria',$categoria);
    $sql->bindValue(':stock',$stock);
    $sql->bindValue(':fecha_registro',$hoy->format('Y-m-d'));

    if($sql->execute()){
    	echo "registro insertado correctamente";
    }else{
    	echo "Error durante la insercion";
    }
}

public function actualizarProducto($id,$nombre,$precio,$categoria,$stock){

     $sql="update productos set 
     nombre=:nombre,precio=:precio,categoria=:categoria,stock=:stock where id=:id";

     $sql=$this->getConnection()->prepare($sql);
     $sql->bindValue(':id',$id);
     $sql->bindValue(':nombre',$nombre);
     $sql->bindValue(':precio',$precio);
     $sql->bindValue(':categoria',$categoria);
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

     $sql="select * from productos
      where UPPER(nombre) like UPPER('%".$nombre."%') limit {$desde},{$filasPagina}";
      //llama a los prodcutos en base a la busqueda y la cantidad pedida

     $sql=$this->getConnection()->prepare($sql);

     $sql->execute();

     return $sql->fetchAll();
}

public function buscadorProductos($nombre){

	$sql="select * from productos where UPPER(nombre) like UPPER('%".$nombre."%')"; 
    //busca los productos en base a la busqueda

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

	$sql="select distinct categoria from productos ORDER BY categoria ASC";
	$sql=$this->getConnection()->prepare($sql);
	$sql->execute();

	return $sql->fetchAll();
}

}

/*$pro=new Producto();
$p=$pro->listadoCategorias();
foreach ($p as $row) {
	echo $row['categoria'];
}*/
?>