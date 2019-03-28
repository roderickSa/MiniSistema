<?php

require_once "../modelo/clientes.php";

$cliente=new Cliente();

switch ($_GET['op']) {
	case 'listarClientes':
		
		$data="";

		$resultado=$cliente->getAllClientes();

		if(count($resultado)>0){

            foreach ($resultado as $row) {
            	
            	$data.='
                      <tr>
                          <td class="text-center">'.$row['nombres'].'</td>
                          <td class="text-center">'.$row['apellidos'].'</td>
                          <td class="text-center">'.$row['dni'].'</td>
                          <td class="text-center">'.$row['correo'].'</td>
                          <td class="text-center">'.$row['telefono'].'</td>
                          <td class="text-center">'.$row['fecha_registro'].'</td>
                          <td class="text-center"><span class="badge badge-primary">'.$row['estado'].'</span></td>
                          <td>
                                  <div class="d-flex justify-content-around">
                                    <button onclick="editarCliente('.$row["id"].')"
		                            class="btn btn-warning pull-left" data-toggle="modal"
		                             data-target="#editClienteModal"
		                            >Editar</button>
		                            <button 
		                            class="btn btn-danger pull-right"
		                             onclick="estadoCliente('.$row["id"].')"
		                            >Estado</button>
                                  </div>
		                      </td>
                      </tr>
           	         ';
            }
		}

        echo $data;

		break;

	case 'registrarCliente';

          if(isset($_POST['nombres']) and
             isset($_POST['apellidos']) and
             isset($_POST['dni']) and
             isset($_POST['correo']) and
             isset($_POST['tel'])){

          $nombres=$_POST['nombres'];
          $apellidos=$_POST['apellidos'];
          $dni=$_POST['dni'];
          $correo=$_POST['correo'];
          $telefono=$_POST['tel'];

          $resultado=$cliente->insertarCliente($nombres,$apellidos,$dni,$correo,$telefono);

            echo $resultado;
          }

	    break;

	case 'editarCliente':

	      $data="";

         if(isset($_GET['id'])){

           $id=$_GET['id'];

           $resultado=$cliente->getCliente($id);

           foreach ($resultado as $row) {
           	
           	 $data['id']=$row['id'];
           	 $data['nombres']=$row['nombres'];
           	 $data['apellidos']=$row['apellidos'];
           	 $data['dni']=$row['dni'];
           	 $data['correo']=$row['correo'];
           	 $data['telefono']=$row['telefono'];
           }
         }

         echo json_encode($data);

	    break;

	case 'actualizarCliente':

         if( isset($_POST['nombres']) and
             isset($_POST['apellidos']) and
             isset($_POST['dni']) and
             isset($_POST['correo']) and
             isset($_POST['telefono']) and
             isset($_POST['id'])){

          $id=$_POST['id'];
          $nombres=$_POST['nombres'];
          $apellidos=$_POST['apellidos'];
          $dni=$_POST['dni'];
          $correo=$_POST['correo'];
          $telefono=$_POST['telefono'];

          $resultado=$cliente->actualizarCliente($id,$nombres,$apellidos,$dni,$correo,$telefono);

            echo $resultado;
          }
 
	    break;

	case 'estadoCliente':
		
        $salida="";

        if(isset($_POST['id'])){
           
           $id=$_POST['id'];

           $estado=$cliente->estadoCliente($id);

           foreach ($estado as $row) {
           	  $salida=$row['estado'];
           }

           if($salida=="ACTIVO"){

           	 $salida=$cliente->cambiarEstadoCliente($id,"INACTIVO");
           	 exit();
           }else if($salida=="INACTIVO"){

           	 $salida=$cliente->cambiarEstadoCliente($id,"ACTIVO");
           	 exit();
           }
        }

        echo $salida;

		break;

}

?>