<?php 

class Conexion 
{
    private $conexion;
    private $host = "localhost";
    private $db = "breyner";
    private $usuario = "breyner";
    private $contrasena = "051207";

    public function __construct()
    {
        try {
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->conexion ="mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8";
            $this->conexion = new PDO($this->conexion, $this->usuario, $this->contrasena, $opciones);
            $this->conexion->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo "Falló la conexión: " . $e->getMessage();
        }
    }

    function getConexion()
    {
        return $this->conexion;
    }

    function cerrarConexion()
    {
        $this->conexion = null;
    }
}