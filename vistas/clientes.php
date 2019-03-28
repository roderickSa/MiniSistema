<?php

require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){

require_once('componentes/navbar.html');

?>

<div class="container jumbotron mt-4">

	<button type="button" class="btn btn-primary mb-4" id="addCliente" 
    data-toggle="modal" data-target="#addClienteModal">Nuevo Cliente</button>

	<table class="table table-bodered table-hover">
		<thead class="thead-dark text-center">
			<tr>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Dni</th>
				<th>Correo</th>
				<th>Telefono</th>
				<th>Fecha Registro</th>
				<th>Estado</th>
				<th>Accion</th>
			</tr>
		</thead>
		<tbody id="listaClientes">
		</tbody>
	</table>
	
</div>

<?php
require_once 'modales/modalClientes/addCliente.php';
require_once 'modales/modalClientes/editCliente.html';
require_once('componentes/footer.html');

}else{
    
	header("Location:index.php");
}?>