<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 require_once 'Model/conexion.php';

 class ProductosModel{

 	 public function getProductosModel($tabla){
        $conexion = new Conexion(); // Crear una instancia de Conexion
         
         $sql = $conexion->conectar()->prepare("SELECT * FROM $tabla pro INNER JOIN categorias cat ON pro.idcategoria = cat.idcategoria ");
         $sql->execute();
         return $sql->fetchAll();

         $sql->close();

       }


 	public function agregarProductosModel($datosModel,$tabla){
    $conexion = new Conexion();
 		$sql = $conexion->conectar()->prepare("INSERT INTO $tabla(nombreproducto,idcategoria,idusuario,precio)
 			VALUES(:nombreproducto,:idcategoria,:idusuario,:precio)");

 		$sql->bindParam(':nombreproducto',$datosModel['nombreproducto'], PDO::PARAM_STR);
 		$sql->bindParam(':idcategoria',$datosModel['idcategoria'],PDO::PARAM_STR);
 		$sql->bindParam(':idusuario',$datosModel['idusuario'],PDO::PARAM_STR);
 		$sql->bindparam(':precio',$datosModel['precio'], PDO::PARAM_STR);

 		if ($sql->execute())  {
 			return 'success';
 		}else{
 			return 'error';
 		}

 		  $sql->close();

 	}

 	
     function actualizarProductosModel($datosModel,$tabla){
      $conexion = new Conexion();
        $sql= $conexion->conectar()->prepare("UPDATE $tabla SET nombreproducto = :nombreproducto ,idcategoria = :idcategoria, precio = :precio, idusuario= :idusuario WHERE idproducto = :idproducto");

      $sql->bindParam(':nombreproducto',$datosModel['nombreproducto'], PDO::PARAM_STR);
      $sql->bindParam(':idcategoria',$datosModel['idcategoria'], PDO::PARAM_INT);
      $sql->bindParam(':precio',$datosModel['precio'], PDO::PARAM_INT);
      $sql->bindParam(':idusuario',$datosModel['idusuario'], PDO::PARAM_INT);
      $sql->bindParam(':idproducto',$datosModel['idproducto'], PDO::PARAM_INT);

           
      if($sql->execute()){

             return "success";
      }else{
    
       return  "error";
      }

      $sql->close();
    }


 	 public function deleteProductosModel($datosModel,$tabla){
    $conexion = new Conexion();
      $sql = $conexion->conectar()->prepare("DELETE FROM $tabla WHERE idproducto = :idproducto");

      $sql->bindParam(':idproducto', $datosModel, PDO::PARAM_INT);

      if ($sql->execute()) {
         return 'success';
      }else{
        return 'Error';
      }

      $sql->close();
    }

 }
         
