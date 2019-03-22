<?php

require_once '../modelo/usuarios.php';

if(isset($_SESSION['usuario'])){
header("Location:home.php");
}

$usuario=new Usuario();

if(!empty($_POST['usuario']) and !empty($_POST['usuario'])){
$usu=$_POST['usuario'];
$pass=$_POST['contraseña'];

$resul=$usuario->login($usu,$pass);

echo $resul;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>

  <!--bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

	<div class="container-fluid text-center mt-4">

		<h3 class="display-4">Formulario de login</h3>
		
	</div>
	<div class="container mt-4 jumbotron">
        <form action="" method="post">
            <!-- Username -->
            <div class="form-group row">
            	<label for="usuario" class="col-form-label col-3">Username:</label>
                <input type="text" name="usuario"
                 class="form-control col-5" placeholder="Usuario">            	
            </div>
            
            <!-- Password -->
            <div class="form-group row">
            	<label for="contraseña" class="col-form-label col-3">Contraseña:</label>
                <input type="password" name="contraseña"
                 class="form-control col-5" placeholder="Contraseña">            	
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Loguearse">
            </div>
        </form>       
    </div>
</body>
</html>

