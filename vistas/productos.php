<?php
require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){
   
require_once('componentes/navbar.html');
require_once('../modelo/productos.php');
$claseProducto=new Producto();
$categorias=$claseProducto->listadoCategorias();
?>

<div class="container mt-4 jumbotron">

    <button type="button" class="btn btn-primary mb-4" id="addProducto" 
    data-toggle="modal" data-target="#addProductoModal">Agregar Producto</button>

	<table class="table table-bordered table-hover">
		<thead class="thead-dark text-center">
			<tr>
				<th>NOMBRE</th>
				<th>CATEGORIA</th>
				<th>PRECIO</th>
				<th>STOCK</th>
				<th>REGISTRO</th>
				<th>ACCIÓN</th>
			</tr>
		</thead>
		<tbody id="listaProductos">
		</tbody>
	</table>

	<div class="d-flex justify-content-center paginas" >
		<nav aria-label="Page navigation example" class="">
			<ul class="pagination" id="paginacion">
                                
			</ul>
		</nav>
	</div>
</div>

<?php

require_once('modalProductos/addProducto.php');
require_once('modalProductos/editProducto.html');
require_once('componentes/footer.html');

}else{
	header("Location:index.php");
}
?>