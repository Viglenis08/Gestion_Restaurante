<?php  

 require_once 'Model/conexion.php';

 class UsuariosModel{
         
          #-----------------------------------------------------------
       #obtener todas usuarios
       public function getUsuariosModel($tabla){
        $conexion = new Conexion();
        $sql = $conexion->conectar()->prepare("SELECT * FROM $tabla");
        $sql->execute();
        $resultados = $sql->fetchAll();
        return $resultados;
    }
    

    public function ingresarUsuariosModel($datosModel , $tabla){
      $conexion = new Conexion();
      $sql = $conexion->conectar()->prepare("INSERT INTO $tabla (nombreusuario , password) VALUES (:nombreusuario, :password)");
  
      $sql->bindParam(':nombreusuario' , $datosModel['nombreusuario'] , PDO::PARAM_STR);
      $sql->bindParam(':password' ,$datosModel['password'], PDO::PARAM_STR);
  
      if ($sql->execute()) {
          return 'success';
      } else {
          return 'error';
      }
      // No es necesario cerrar la conexión aquí
  }
  


      	public function deleteUsuariosModel($datosModel,$tabla){
          $conexion = new Conexion();  
      $sql = $conexion->conectar()->prepare("DELETE FROM $tabla WHERE idusuario = :idusuario");

      $sql->bindParam(':idusuario', $datosModel, PDO::PARAM_INT);

      if ($sql->execute()) {
         return 'success';
      }else{
        return 'Error';
      }
    }


  public function editarUsuariosModel($datosModel , $tabla){
    $conexion = new Conexion();  
     $sql = $conexion->conectar()->prepare("UPDATE $tabla SET nombreusuario = :nombreusuario, password = :password WHERE idusuario = :idusuario");

     $sql->bindParam(':nombreusuario',$datosModel['nombreusuario'] ,PDO::PARAM_STR);
     $sql->bindParam(':password',$datosModel['password'],PDO::PARAM_STR);
     $sql->bindParam(':idusuario',$datosModel['idusuario'],PDO::PARAM_STR);

     if ($sql->execute()) {
       return 'success';
     }else{
      return 'error';
     }
  }


 }