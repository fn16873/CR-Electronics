<?php
    class DatabaseConnection 
    {
        // Datos de conexión a la base de datos
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "crelectronics";

        // Método para establecer la conexión a la base de datos
        public function connect() 
        {
            try
            {
                // Crear conexión a la base de datos utilizando PDO
                $dns = "mysql:host=$this->servername;dbname=$this->dbname";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ];
                // Establecer la conexión y devolver el objeto PDO
                return new PDO($dns, $this->username, $this->password, $options);
            } catch (PDOException $e) 
            {
                // Manejar errores de conexión
                die("Conexión fallida: " . $e->getMessage());
                exit();
            }
        }
    } 
?>