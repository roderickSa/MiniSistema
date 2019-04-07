<?php

require_once '../config/conexion.php';

$inactividad=1200;

$vidaSesion=time()-$_SESSION['tiempo'];

if(isset($_SESSION['usuario'])){

		require_once('componentes/navbar.html');

?>

<div class="display-4">
	<?php echo "Bienvenido usuario: ".$_SESSION['usuario'];?>
</div>

<?php

require_once('componentes/footer.html');

}else{

	header("Location:index.php");
}
?>