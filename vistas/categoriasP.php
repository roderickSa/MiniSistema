<?php
require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){
   
require_once('componentes/navbar.html');
require_once('../modelo/categoriasP.php');
$claseCategoriaP=new CategoriaP();
?>

	<div class="container mt-4 jumbotron">

    <button type="button" class="btn btn-primary mb-4" id="addCategoriaP" 
    data-toggle="modal" data-target="#addCategoriaPModal">Agregar Categoria</button>

	<table class="table table-bordered table-hover">
		<thead class="thead-dark text-center">
			<tr>
				<th>NOMBRE</th>
				<th>ACCION</th>
			</tr>
		</thead>
		<tbody id="listaCategoriasP">
		</tbody>
	</table>

</div>

<?php

require_once('modales/modalCategoriasP/addCategoriaP.php');
require_once('modales/modalCategoriasP/editCategoriaP.html');
require_once('componentes/footer.html');

}else{
	header("Location:index.php");
}
?>