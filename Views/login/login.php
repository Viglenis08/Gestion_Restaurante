<?php 
$servidor ="localhost";
$baseDeDatos ="restaurant";
$usuario ="root";
$contrasenia="";


session_start();
	try {
		$error = '';
		$enviar='';
		$enviado='';

		$conexion =  new PDO ("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$nomusuario = $_POST['nombreusuario'];
			$password = $_POST['password'];
     $sql = $conexion->prepare('SELECT * FROM usuarios WHERE nombreusuario = :nombreusuario AND 
     	                        password = :password');
     $sql->execute(array(':nombreusuario'=>$nomusuario,
     	                  ':password'=>$password));

     $resultado = $sql->fetch();
        if ($resultado != false) {
	      $_SESSION['nombreusuario'] = $nomusuario;
	      $enviar .=  '<center> Bienvenido <br>'. ucwords($resultado['nombreusuario']). '</center> <br>';
	      $enviar .= '<meta http-equiv="refresh" content="4;url=../../index.php">';
	      $enviado .= '<center><i class="fa fa-cog fa-spin fa-3x fa-fw"></i><br>
	                  <span class="">Accediendo Al Sistema...</span></center><br>';
	   
   } else {
   $error .= '<li> Los Datos ingresados son Incorrectos </li>';
   
}

		}
	} catch (Exception $e) {
		echo "Error  de conexion a la base de datos.";
	}


	require 'login.view.php';
 ?>