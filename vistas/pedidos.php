<?php

require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){

require_once 'componentes/navbar.html';
?>	

<div class="container jumbotron mt-4">
	<form action="" method="post">

		<input type="hidden" name="cliente_id" id="cliente_id" disabled>

		<div class="form-group">
			<label for="cliente">Cliente</label>
			<input type="text" name="cliente" id="nombreCliente"
			 placeholder="Buscar cliente..." class="form-control col-4" autocomplete="off">
			 <div class="col-4">
			 	<ul class="list-group" id="comboNombres"></ul>
			 </div>			
		</div>
		<div class="container mb-3 mt-4">
			<div class="form-goup row">
				<label for="dni" class="col-form-label col-1">DNI</label>
				<input class="form-control col-3" type="text" name="dni" id="dniCliente"
				 disabled="disabled">

				<label for="correo" class="col-form-label col-1">Correo</label>
				<input class="form-control col-3" type="text" name="correo" id="correoCliente"
				 disabled="disabled">
			</div>
	    </div>
        <div class="form-group row">
        	<input class="btn btn-outline-primary" type="submit" name="enviar" id="buttonCargarPedido" 
        	 value="Generar Pedido" onclick ="cargarPedido(event);">
        </div>	
		
	</form>
</div>

	<div class="container p-3 mt-4 mb-4 bg-info text-white" id="formulario_generar_pedidos">
		<form action="" method="post" accept-charset="utf-8">
			  <div class="form-group row">
			  	  <label for="id_pedido" class="col-form-label col-2">ID del Pedido</label>
			  	  <input class="form-control col-1" type="text" name="id_pedido" id="id_pedido" disabled>
			  </div>
			  <div class="form-group">

			  	  <input type="hidden" name="idProducto" id="idProducto" disabled>

			  	  <label for="producto">Producto</label>
			  	  <input class="form-control col-4" type="text" name="producto"
			  	   id="nombreProducto" autocomplete="off" placeholder="Buscar producto...">

			  	   <div class="col-4">
					   <ul class="list-group" id="comboProductos"></ul>
				   </div>	

			  </div>
			  <div class="form-group row">

			  	  <label for="categoria" class="col-form-label col-1">Categoria</label>
			  	  <input class="form-control col-4" type="text" name="categoriaProducto"
			  	   id="categoriaProducto" autocomplete="off" placeholder="Categoria" disabled>			  

			  	  <label for="cantidad" class="col-form-label col-1">Cantidad</label>
			  	  <input class="form-control col-2" type="number" name="cantidadPedido"
			  	   id="cantidadPedido" autocomplete="off" placeholder="Cantidad">

			  	  <label for="total" class="col-form-label col-1">Total</label>
			  	  <input class="form-control col-2" type="number" name="totalPedido"
			  	   id="totalPedido" autocomplete="off" disabled>

			  </div>

			  <div id="nuevoProducto"></div>

			  <div class="container">
			  	  <div class="d-flex justify-content-around">
				  	  <button class="btn btn-warning pull-left" type="button"
				  	   onclick="agregarProducto(event);">
				  	  Añadir Producto</button>

				  	  <button class="btn btn-danger pull-left" type="button" id="quitarUltimoPedido" 
				  	   onclick="quitarProducto(event);">
				  	  Quitar Producto</button>
			  	  
				  	  <button class="btn btn-success pull-center" type="button" 
				  	  onclick="aplicarPedidoDetalle(event)
				  	  ;">Aplicar Pedido</button>
			  	  
			  	  	  <button class="btn btn-success pull-right" type="button" 
			  	  	  onclick="registroPedidoDetalle(event);">
			  	  	  Generar Pedido</button>
			  	  </div>			  	  
			  </div>
		</form>		
	</div>


<?php

require_once 'componentes/footer.html';

}else{
	header("Location:index.php");
}

?>