<?php
require 'Views/modules/ventas/conexion.php';
ob_start();

$conexion = new Conexion_bd();
$pdo = $conexion->conectar(); // Obtener una instancia de PDO válida

$tabla = $_GET['action'];

if (isset($_GET['idmesa'])) {
    $id = $_GET['idmesa'];

    $sql = $pdo->prepare("DELETE FROM $tabla WHERE idmesa = :id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    
    header("location:$tabla");
}

if (isset($_POST['agregarBebidas'])) {
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = $_POST['fecha'];
    $usu = $_POST['usuario'];
    $productos = $_POST['producto'];
    
      foreach ($productos as $key) { // Cambia $key a $productos aquí
        if (isset($key[0]) && isset($key[1])) {
            list($idproducto, $precio) = explode('-', $key);
        $conexion = new Conexion_bd();    
        $pdo = $conexion->conectar(); // Obtener una instancia de PDO válida
        $sql = $pdo->prepare("INSERT INTO $tabla (idproducto, precio, fecha, idusuario) VALUES (:idproducto, :precio, :fecha, :idusuario)");
        $sql->bindParam(':idproducto', $idproducto, PDO::PARAM_INT);
        $sql->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sql->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $sql->bindParam(':idusuario', $usu, PDO::PARAM_INT);
        $sql->execute();
    }
  }

    header("location:$tabla");
}

if (isset($_POST['venta'])) {
  $conexion = new Conexion_bd();
	$pdo = $conexion->conectar();
    $sql = $pdo->prepare("INSERT INTO detalles (idproducto, precio, fecha, idusuario, mesa)
        SELECT ta.idproducto, ta.precio, ta.fecha, ta.idusuario, ta.mesa
        FROM $tabla ta");
    $sql->execute();
    $conexion = new Conexion_bd();
    $pdo = $conexion->conectar();
    $sql = $pdo->prepare("DELETE FROM $tabla");
    $sql->execute();
    
    header("location:$tabla");
}
?>


<div class="container" style="overflow: auto; width: 720px; height: 400px;">

	<center><h1><i class="fa fa-table" aria-hidden="true"> </i> <?php echo $tabla; ?></h1>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bebidas" data-whatever="@mdo"><i class="fa fa-plus-square"> </i> ADICIONAR PEDIDOS </button></center>
	
  <?php require 'Views/modal/modal_agregar_productos.php'; ?>


  <?php   $pdo = $conexion->conectar(); // Obtener una instancia de PDO válida

$consult = $pdo->query("SELECT * FROM $tabla ta JOIN productos pro ON ta.idproducto = pro.idproducto");
  ?>
  
  	<table class="table table-bordered" id="imprimeme">
	  <thead>
	    <tr>
      <th>NUMERO DE MESA</th>
	      <th>CODIGO DEL PRODUCTO</th>
	      <th>NOMBRE DEL PRODUCTO</th>
	      <th>PRECIO</th>
	    </tr>
	  </thead>
	  <tbody>

  <?php foreach ($consult as $key): ?>
	    <tr>  
      <td><?php echo $key['idmesa'] ?></td>
            <td><?php echo $key['idproducto'] ?></td>
            <td><?php echo $key['nombreproducto'] ?></td>
	      <td><i class="fa fa-usd"> </i> <?php echo $key['precio'] ?> <a href="index.php?action=<?php echo $tabla ?>&idmesa=<?php echo $key['idmesa']  ?>" class="pull-right" ><i class="fa fa-trash-o btn btn-danger btn-sm"></i></a> </td>
	    </tr>
	    
      <?php endforeach ?>
      <tr>
        <td></td> <!-- Esta celda está vacía para ocupar el espacio de NUMERO DE MESA -->
        <td><i class="fa fa-usd fa-spin fa-2x"></i></td> <!-- Esta celda está vacía para ocupar el espacio de CODIGO DEL PRODUCTO -->
        <td colspan="2">SUB TOTAL</td>
        <?php 
        // Utiliza la instancia de PDO existente en lugar de crear una nueva instancia de Conexion_bd
        $total = $pdo->prepare("SELECT SUM(PRECIO) AS TOTAL FROM $tabla");
        $total->execute();
        foreach ($total as $key) {
            $result = $key['TOTAL'];
        } ?>
        <td><i class="fa fa-usd"></i> <?php echo $result; ?></td>
    </tr>
</tbody>
	  </tbody>
</table>


<?php 
$conexion = new Conexion_bd();
$pdo = $conexion->conectar();
$sql = $pdo->prepare("SELECT * FROM $tabla, usuarios ");
  $sql->execute();
   ?>
		<form method="post">
		 <?php foreach ($sql as $key) :?>
			<input type="hidden" name="fecha[]" value="<?php echo date("Y-m-d"); ?>">
			<input type="hidden" name="idproducto[]" value="<?php echo $key['idproducto'] ?>">
			<input type="hidden" name="precio[]" value="<?php echo $key['precio'] ?>">
			<input type="hidden" name="idusuario[]" value="<?php echo $key['idusuario'] ?>">
		  <?php endforeach; ?>  
		   <input type="submit" class="btn btn-danger" name="venta" value="$ Finalizar Venta" onclick="imprimir()">
		</form>

  
</div>
<script>
	function imprimir(){
  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
</script>