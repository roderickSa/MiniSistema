<?php

require_once '../modelo/pedidos.php';

$pedido=new Pedido();

switch ($_GET['op']){

   case 'buscarNombre':
   	
     if(isset($_GET['nombres'])){
        
        $data="";
        $nombres=$_GET['nombres'];

        $resultado=$pedido->buscaNombre($nombres);
        if(count($resultado)>0){
           
           foreach ($resultado as $row) {
           	
           	 $data.='<li class="list-group-item" 
           	          onclick="elijeItemPedido('.$row["id"].',
           	                             '.'\''.str_replace("'", "\'", $row['nombres']).'\',
           	                             '.'\''.str_replace("'", "\'", $row['apellidos']).'\',
           	                             '.'\''.str_replace("'", "\'", $row['dni']).'\',
           	                             '.'\''.str_replace("'", "\'", $row['correo']).'\')">
           	          <span>'.$row["nombres"].' '.$row["apellidos"].'</span></li>';
           }
        }
     }

     echo $data;

   	break;

    case 'registrarPedido':
    	
        if(isset($_POST['cliente_id'])){           
           
           $cliente_id=$_POST['cliente_id'];

           $resultado=$pedido->registrarPedido($cliente_id);  //registro pedido          

        }

        echo $resultado;
    	break;

    case 'buscarPedido':

        $data="";

	    if(isset($_GET['cliente_id'])){           
	           
	       $cliente_id=$_GET['cliente_id'];
	    	
	       $resultado=$pedido->getPedido($cliente_id);  //llama al pedido del cliente

	       foreach ($resultado as $row) {
           	 
               $data['id']=$row['id'];
           }

           $pedido->updateEstadoPedido($cliente_id);   //actualiza el estado del pedido

           }
	        echo json_encode($data);

	    	break;

	case 'buscarProducto':
   	
     if(isset($_GET['producto'])){
        
        $data="";
        $producto=$_GET['producto'];

        $resultado=$pedido->buscaProducto($producto);
        if(count($resultado)>0){
           
           foreach ($resultado as $row) {
           	
           	 $data.='<li class="list-group-item" 
           	          onclick="elijeItemProducto('.$row["id"].',
           	                             '.'\''.str_replace("'", "\'", $row['nombre']).'\',
           	                             '.'\''.str_replace("'", "\'", $row['categoria']).'\',
           	                             '.$row["precio"].')">
           	          <span>'.$row["nombre"].' - '.$row["categoria"].'</span></li>';
           }
        }
     }

     echo $data;

   	break;

   	case 'registrarPedidoDetalle':
    	
        if(isset($_POST['cantidad']) and
           isset($_POST['total'])  and
           isset($_POST['id_pedido'])  and
           isset($_POST['id_producto'])
           ){           
           
           $cantidad=$_POST['cantidad'];
	       $total=$_POST['total'];
	       $id_pedido=$_POST['id_pedido'];
	       $id_producto=$_POST['id_producto'];

           for ($i=0; $i < count($id_producto) ; $i++) { 
           	
           	 $resultado=$pedido->registrarPedidoDetalle
           	                     ($cantidad[$i],$total[$i],$id_pedido,$id_producto[$i]); 
           }    

        }

        echo $resultado;
    	break;

    case 'nuevoProducto':
    	
        $data='
               <div class="identificadorColumna">
	               <div class="form-group">

				  	  <input type="hidden" name="idProducto[]" class="idPro" disabled>

				  	  <label for="producto">Producto</label>
				  	  <input class="form-control col-4 nomPro" type="text" name="producto[]"
				  	    autocomplete="off" placeholder="Buscar producto...">

				  	   <div class="col-4">
						   <ul class="list-group cmbPro"></ul>
					   </div>	

				  </div>
				  <div class="form-group row">

				  	  <label for="categoria" class="col-form-label col-1">Categoria</label>
				  	  <input class="form-control col-4 ctgPro" type="text" name="categoriaProducto[]"
				  	    autocomplete="off" placeholder="Categoria" disabled>			  

				  	  <label for="cantidad" class="col-form-label col-1">Cantidad</label>
				  	  <input class="form-control col-2 cantPro" type="number" name="cantidadPedido[]"
				  	    autocomplete="off" placeholder="Cantidad">

				  	  <label for="total" class="col-form-label col-1">Total</label>
				  	  <input class="form-control col-2 totPro" type="number" name="totalPedido[]"
				  	    autocomplete="off" disabled>

				  </div>
			  </div>
        ';

        echo $data;

    	break;

}

?>