<?php

require_once '../config/conexion.php';

class CategoriaP extends Conexion{

  public function getAllCategorias(){

      $sql="select * from categorias_productos";
      $sql=$this->getConnection()->prepare($sql);
      $sql->execute();

      return $sql->fetchAll();
  }

  public function getCategoria($id){

      $sql="select * from categorias_productos where id=:id";
      $sql=$this->getConnection()->prepare($sql);
      $sql->bindValue(':id',$id);
      $sql->execute();

      return $sql->fetchAll();
  }

  public function insertarCategoria($nombre){

      $sql="insert into categorias_productos(nombre) values(:nombre) ";
      $sql=$this->getConnection()->prepare($sql);
      $sql->bindValue(':nombre',$nombre);
      $resul=$sql->execute();

      if($resul>0){
          return "Registro insertado correctamente";
      }else{
      	return "Error al insertar";
      }
  }

  public function actualizarCategoria($id,$nombre){

      $sql="update categorias_productos set nombre=:nombre where id=:id ";
      $sql=$this->getConnection()->prepare($sql);
      $sql->bindValue(':id',$id);
      $sql->bindValue(':nombre',$nombre);
      $resul=$sql->execute();

      if($resul>0){
          return "Registro actualizado correctamente";
      }else{
      	return "Error al actualizar";
      }
  }

  public function eliminarCategoria($id){

      $sql="delete from categorias_productos where id=:id ";
      $sql=$this->getConnection()->prepare($sql);
      $sql->bindValue(':id',$id);
      $resul=$sql->execute();

      if($resul>0){
          return "Registro eliminado correctamente";
      }else{
      	return "Error al eliminar";
      }
  }

}
/*
$cat=new CategoriaP();
var_dump($cat->eliminarCategoria(4));
*/
?>