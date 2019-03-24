<?php

require_once("../modelo/productos.php");

$producto=new Producto();
$registros_por_pagina=5;

switch ($_GET['op']) {

	case 'buscadorProductos':   //busca por nombre ingresado, si el nombre es vacio llama a todos
		
        if(isset($_GET['nombre'])){

            $data="";
        	$nombre=$_GET['nombre'];

            if(!empty($_GET['nombre'])){

            	$resultado=$producto->buscadorProductos($nombre);

                if(count($resultado)>0){

                	foreach ($resultado as $row) {
                		
                		$data.='
                		  <tr>
                		      <td>'.$row["nombre"].'</td>
                		      <td>'.$row["categoria"].'</td>
                		      <td>'.$row["precio"].'</td>
		                      <td>'.$row["stock"].'</td>
		                      <td>'.$row["fecha_registro"].'</td>
		                      <td>
                                  <div class="d-flex justify-content-around">
                                    <button onclick="editarProducto('.$row["id"].')"
		                            class="btn btn-warning pull-left" data-toggle="modal" data-target="#editProductoModal"
		                            >Editar</button>
		                            <button 
		                            class="btn btn-danger pull-right"
		                             onclick="eliminarProducto('.$row["id"].')"
		                            >Eliminar</button>
                                  </div>
		                      </td>
		                  </tr> ';
                	}

                }
            
            }else{

            	$resultado=$producto->getAllProductos();

            	if(count($resultado)>0){

                	foreach ($resultado as $row) {
                		
                		$data.='
                		  <tr>
                		      <td>'.$row["nombre"].'</td>
                		      <td>'.$row["categoria"].'</td>
                		      <td>'.$row["precio"].'</td>
		                      <td>'.$row["stock"].'</td>
		                      <td>'.$row["fecha_registro"].'</td>
		                      <td>
                                  <div class="d-flex justify-content-around">
                                    <button onclick="editarProducto('.$row["id"].')"
		                            class="btn btn-warning pull-left" data-toggle="modal" data-target="#editProductoModal"
		                            >Editar</button>
		                            <button 
		                            class="btn btn-danger pull-right"
		                             onclick="eliminarProducto('.$row["id"].')"
		                            >Eliminar</button>
                                  </div>
		                      </td>
		                  </tr> ';
                	}

                }

            }

            echo $data;
        }


		break;

	case 'barraPaginacionBuscador': 
	//crear paginacion por nombre ingresado, si el nombre es vacio llama a todos

	if(isset($_GET['nombre'])){

        $data="";
		$nombre=$_GET['nombre'];

       if(!empty($_GET['nombre'])){

       	$resultado=$producto->buscadorProductosConteo($nombre);

       	foreach ($resultado as $row) {
       		
       		$total=ceil($row['total']/$registros_por_pagina);
       	}

       	for ($i=1; $i <=$total ; $i++) { 
       		
       		$data.='<li class="page-item"><a class="page-link text-muted">'. $i .'</a></li>';
       	}
        
       }else{

       	$resultado=$producto->totalProductos();

       	foreach ($resultado as $row) {
       		
       		$total=ceil($row['total']/$registros_por_pagina);
       	}

       	for ($i=1; $i <=$total ; $i++) { 
       		
       		$data.='<li class="page-item"><a class="page-link text-muted">'. $i .'</a></li>';
       	}
       }

       echo $data;
	}

	break;

	case 'paginacion':

    if(isset($_GET['nombre']) and isset($_GET['pagina'])){

    	$data="";

    	$nombre=$_GET['nombre'];
    	$pagina=$_GET['pagina'];

    	$desde=($pagina-1)*$registros_por_pagina;

    	$resultado=$producto->paginacionProductos($nombre,$desde,$registros_por_pagina);

    	if(count($resultado)>0){
            
           foreach ($resultado as $row) {
           
             $data.='
                		  <tr>
                		      <td>'.$row["nombre"].'</td>
                		      <td>'.$row["categoria"].'</td>
                		      <td>'.$row["precio"].'</td>
		                      <td>'.$row["stock"].'</td>
		                      <td>'.$row["fecha_registro"].'</td>
		                      <td>
                                  <div class="d-flex justify-content-around">
                                    <button onclick="editarProducto('.$row["id"].')"
		                            class="btn btn-warning pull-left" data-toggle="modal" data-target="#editProductoModal"
		                            >Editar</button>
		                            <button 
		                            class="btn btn-danger pull-right"
		                             onclick="eliminarProducto('.$row["id"].')"
		                            >Eliminar</button>
                                  </div>
		                      </td>
		                  </tr> ';
           }
    	}
       
       echo $data;
    }

	break;

	case 'eliminarProducto':

	$data="";

	if(isset($_POST['id'])){
     
     $id=$_POST['id'];

     $resultado=$producto->getProducto($id);

     foreach ($resultado as $row) {
     	
     	$buscando=$row['id'];

     	if($buscando!=null){
           
           $producto->eliminarProducto($buscando);
           $data.="Producto Eliminado";
     	}
     }

	}

	echo $data;
		
	break;

	case 'insertarProducto':

	if(isset($_POST['nombre']) and isset($_POST['id_categoria']) and
	   isset($_POST['precio']) and isset($_POST['stock'])){
     
     $nombre=$_POST['nombre'];
	 $id_categoria=$_POST['id_categoria'];
	 $precio=$_POST['precio'];
	 $stock=$_POST['stock'];

     $resultado=$producto->insertarProducto($nombre,$id_categoria,$precio,$stock);

	}

	echo $resultado;
		
	break;

	case 'buscarPorId':

	$datos;

	if(isset($_GET['id'])){
     
     $id=$_GET['id'];

     $resultado=$producto->getProducto($id);

     if(count($resultado)>0){

     	foreach ($resultado as $row) {
     		
     		$datos['id']=$row['id'];
     		$datos['nombre']=$row['nombre'];
     		$datos['precio']=$row['precio'];
     		$datos['categoria']=$row['categoria'];
     		$datos['stock']=$row['stock'];
     	}

     }

	}

	echo json_encode($datos);
		
	break;

	case 'actualizarProducto':

	if(isset($_POST['id']) and isset($_POST['nombre']) and isset($_POST['id_categoria']) and
	   isset($_POST['precio']) and isset($_POST['stock'])){
     
     $id=$_POST['id'];
     $nombre=$_POST['nombre'];
  	 $id_categoria=$_POST['id_categoria'];
  	 $precio=$_POST['precio'];
  	 $stock=$_POST['stock'];

     $resultado=$producto->actualizarProducto($id,$nombre,$precio,$id_categoria,$stock);

	}

	echo $resultado;
		
	break;
	
}


?>