<?php 
    class Database
    {
        private $hostname = "mysql8";  // Nombre del servicio de MySQL en docker-compose.yml
        private $database = "flexografia";
        private $username = "root";   // Usuario de MySQL
        private $password = "pass";       // La contraseña proporcionada en el compose
        private $charset = "utf8";

        function conectar(){
            try{
                $conexion = "mysql:host=".$this ->hostname."; dbname=".$this->database.";charset=".$this->charset;

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $pdo = new PDO($conexion,$this->username,$this->password,$options); 
                return $pdo;
        }catch(PDOException $e){
            echo "Error de conexion: ".$e->getMessage();
            exit;
        }

    }
}

?>