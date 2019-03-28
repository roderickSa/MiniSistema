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
           	          onclick="elijeItem('.$row["id"].',
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

}

?>