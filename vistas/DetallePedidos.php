<?php

require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){

require_once 'componentes/navbar.html';
?>

<div class="container mt-4 jumbotron">

	<table class="table table-bordered table-hover">
		<thead class="thead-dark text-center">
			<tr>
				<th>N° PEDIDO</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>FECHA PEDIDO</th>
				<th>DETALLE</th>
			</tr>
		</thead>
		<tbody id="listaPedidoDetalle">
		</tbody>
	</table>

	<div class="d-flex justify-content-center paginas" >
		<nav aria-label="Page navigation example" class="">
			<ul class="pagination" id="paginacionPedidoDetalle">
                                
			</ul>
		</nav>
	</div>
</div>

<?php
require_once 'componentes/footer.html';
require_once 'modales/modalPedidoDetalle/detallePedido.html';
}else{
	header("Location:index.php");
}
?>