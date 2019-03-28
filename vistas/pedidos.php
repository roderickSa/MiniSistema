<?php

require_once '../config/conexion.php';

if(isset($_SESSION['correo'])){

require_once 'componentes/navbar.html';
?>	

<div class="container jumbotron mt-4">
	<form action="" method="post">

		<input type="hidden" name="id_cliente" id="id_cliente" >

		<div class="form-group">
			<label for="cliente">Cliente</label>
			<input type="text" name="cliente" id="nombreCliente"
			 placeholder="Buscar cliente..." class="form-control col-5" autocomplete="off">
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
        	<input class="btn btn-outline-primary" type="submit" name="enviar"
        	 value="Generar Pedido" onclick ="generarPedido(evt)">
        </div>	
		
	</form>

	<div class="container">
				
	</div>
</div>


<?php

require_once 'componentes/footer.html';

}else{
	header("Location:index.php");
}

?>