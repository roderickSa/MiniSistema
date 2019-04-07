<?php

require_once '../modelo/DetallePedido.php';

$Detalle_Pedido=new DetallePedido();

$registrosPorPagina=6;

switch ($_GET['op']) {
	case 'listaPedidoDetalle':
		
        $resultado=$Detalle_Pedido->getAll();

        $data="";

        foreach ($resultado as $row) {
                 	
        	$data.='
                  <tr class="text-center">
	                  <td>'.$row['id_pedido'].'</td>
	                  <td>'.$row['nombres'].'</td>
	                  <td>'.$row['apellidos'].'</td>
	                  <td>'.$row['fecha_pedido'].'</td>
	                  <td><span class="badge badge-warning">
	                  ver detalle</span></td>
                  </tr>
                 ';
        }

        echo $data;

		break;

	case 'muestraPaginacionPedidoDetalle':
		
        $resultado=$Detalle_Pedido->cantidadPedido_detalle();

        $data="";

        foreach ($resultado as $row) {
        	
        	$total=ceil($row['cantidad']/$registrosPorPagina);
        }

        for ($i=1;$i<=$total;$i++) {
                 	
        	$data.='<li class="page-item">
        	<a class="page-link text-muted" onclick="paginacion('.$i.');">'. $i .'</a>
        	</li>';
        }

        echo $data;

		break;

	case 'paginacionPedidoDetalle':

	    if(isset($_GET['pagina'])){

	    	$data="";

	    	$pagina=$_GET['pagina'];

	    	$desde=($pagina-1)*$registrosPorPagina;

	    	$resultado=$Detalle_Pedido->paginacionPedido_detalle($desde,$registrosPorPagina);

	    	foreach ($resultado as $row) {
	    		
	    		$data.='
                  <tr class="text-center">
	                  <td>'.$row['id_pedido'].'</td>
	                  <td>'.$row['nombres'].'</td>
	                  <td>'.$row['apellidos'].'</td>
	                  <td>'.$row['fecha_pedido'].'</td>
	                  <td><button class="btn btn-outline-primary" 
	                  onclick="verDetallePedido('.$row["id"].','.$row["id_producto"].');">
	                  ver detalle</button></td>
                  </tr>
                 ';
	    	}

	    }

        echo $data;

		break;

	case 'getIdProducto':

	$data;

	    if(isset($_GET['id_producto'])){

	    	$id=$_GET['id_producto'];

	    	$resultado=$Detalle_Pedido->getIdProducto($id);        

        foreach ($resultado as $row) {
                 	
        	$data['nombre']=$row['nombre'];
        	$data['precio']=$row['precio'];
        	$data['categoria']=$row['categoria'];
        }

	    }        

        echo json_encode($data);

		break;

	case 'getPedidoDetalle':

	$data;

	    if(isset($_GET['id_pedido_detalle'])){

	    	$id=$_GET['id_pedido_detalle'];

	    	$resultado=$Detalle_Pedido->getPedidoDetalle($id);        

        foreach ($resultado as $row) {
                 	
        	$data['nombres']=$row['nombres'];
        	$data['apellidos']=$row['apellidos'];
        	$data['cantidad']=$row['cantidad'];
        	$data['total']=$row['total'];
        }

	    }        

        echo json_encode($data);

		break;

	case 'getAllPedido':
		
        $resultado=$Detalle_Pedido->getAllPedido();

        $data="";

        foreach ($resultado as $row) {
                 	
        	$data.='
                  <tr class="text-center">
	                  <td>'.$row['id'].'</td>
	                  <td>'.$row['nombres'].'</td>
	                  <td>'.$row['apellidos'].'</td>
	                  <td>'.$row['fecha_pedido'].'</td>
	                  <td><span class="badge badge-warning">
	                  ver detalle</span></td>
                  </tr>
                 ';
        }

        echo $data;

		break;

	case 'muestraPaginacionPedidos':
		
        $resultado=$Detalle_Pedido->cantidadPedidos();

        $data="";

        foreach ($resultado as $row) {
        	
        	$total=ceil($row['cantidad']/$registrosPorPagina);
        }

        for ($i=1;$i<=$total;$i++) {
                 	
        	$data.='<li class="page-item">
        	<a class="page-link text-muted" onclick="paginacionPedidos('.$i.');">'. $i .'</a>
        	</li>';
        }

        echo $data;

		break;

	case 'paginacionPedidos':

	    if(isset($_GET['pagina'])){

	    	$data="";

	    	$pagina=$_GET['pagina'];

	    	$desde=($pagina-1)*$registrosPorPagina;

	    	$resultado=$Detalle_Pedido->paginacionPedidos($desde,$registrosPorPagina);

	    	foreach ($resultado as $row) {
	    		
	    		$data.='
                  <tr class="text-center">
	                  <td>'.$row['id'].'</td>
	                  <td>'.$row['nombres'].'</td>
	                  <td>'.$row['apellidos'].'</td>
	                  <td>'.$row['fecha_pedido'].'</td>
	                  <td><button class="btn btn-outline-primary" 
	                  onclick="verDetallePedido('.$row["id"].');">
	                  ver detalle</button></td>
                  </tr>
                 ';
	    	}

	    }

        echo $data;

		break;

	case 'getProductosFromIdPedido':

	    $data="";

	    if(isset($_GET['id_pedido'])){

	    	$id_pedido=$_GET['id_pedido'];

	    	$resultado=$Detalle_Pedido->getProductosFromIdPedido($id_pedido);        

	        foreach ($resultado as $row) {

	        	$data.='
	                  <tr class="text-center">
		                  <td>'.$row['id_pedido_detalle'].'</td>
		                  <td>'.$row['producto'].'</td>
		                  <td>S/. '.$row['precio'].'</td>
		                  <td>'.(int)$row['cantidad'].'</td>
		                  <td>S/. '.$row['total'].'</td>
	                  </tr>
	                 ';
	        }

	    }        

        echo $data;

		break;

	case 'getTotalProductosFromIdPedido':

	    $data="";

	    if(isset($_GET['id_pedido'])){

	    	$id_pedido=$_GET['id_pedido'];

	    	$resultado=$Detalle_Pedido->getTotalProductosFromIdPedido($id_pedido);  

	    	if(count($resultado)>0 and $resultado!=null){

	    		foreach ($resultado as $row) {

                $data='
                <div class="row">

                <div class="col-5">
                	<p class="display-4">Monto total:</p>
                </div>

                <div class="col-7">
                	<label class="display-4 text-success">S/. '.$row["total"].'</label>
                </div>
                	
                </div>              
                
                      ';
	         }    

	    	}else{
                  
                  $data="";
	    	}	        

         }

         echo $data;

		break;

}

?>