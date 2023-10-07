<?php
class Conexion_bd {
    public $servidor = "localhost";
    public $baseDeDatos = "restaurant";
    public $usuario = "root";
    public $contrasenia = "";

    public function conectar() {
        try {
            $conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDeDatos", $this->usuario, $this->contrasenia);
            return $conexion;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}
$conexion = new Conexion_bd();
?>

