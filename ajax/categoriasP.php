<?php

require_once("../modelo/categoriasP.php");

$categoriasP=new CategoriaP();

switch ($_GET["op"]) {

	case 'listadoCategorias':
		
        $resultado=$categoriasP->getAllCategorias();
        $data="";

        if(count($resultado)>0){

           foreach ($resultado as $row) {
           	
           	  $data.='
                      <tr>
                          <td class="text-center">'.$row['nombre'].'</td>
                          <td>
                                  <div class="d-flex justify-content-around">
                                    <button onclick="editarCategoriaP('.$row["id"].')"
		                            class="btn btn-warning pull-left" data-toggle="modal"
		                             data-target="#editCategoriaPModal"
		                            >Editar</button>
		                            <button 
		                            class="btn btn-danger pull-right"
		                             onclick="eliminarCategoriaP('.$row["id"].')"
		                            >Eliminar</button>
                                  </div>
		                      </td>
                      </tr>
           	         ';
           }
        }

        echo $data;

		break;

	case 'editarCategoria':
		
        $id=$_GET['id'];
        $salida;

        $resultado=$categoriasP->getCategoria($id);

        if(count($resultado)>0){

           foreach ($resultado as $row) {
           	
           	  $salida['id']=$row['id'];
           	  $salida['nombre']=$row['nombre'];
           }
        }

        echo json_encode($salida);

		break;

	case 'actualizarCategoria':

        if(isset($_POST["nombre"]) and isset($_POST["id"])){

        	$id=$_POST["id"];
            $nombre=$_POST["nombre"];

        	$resultado=$categoriasP->actualizarCategoria($id,$nombre);

        } 

        echo $resultado;

		break;

    case 'insertarCategoria':

        if(isset($_POST["nombre"])){

            $nombre=$_POST["nombre"];

        	$resultado=$categoriasP->insertarCategoria($nombre);

        } 

        echo $resultado;

		break;

	case 'eliminarCategoria':

        if(isset($_POST["id"])){

        	$id=$_POST["id"];

        	$resultado=$categoriasP->eliminarCategoria($id);

        } 

        echo $resultado;

		break;
	
}

?>