<?php
    class OracleDB {
        private $conn;

        public function __construct() {
            $host     = "localhost";
            $port     = "1522";
            $sid      = "ORCL";
            $user     = "SoundShelf";
            $password = "Basedatos123456";

            $this->conn = oci_connect($user, $password, "$host:$port/$sid");

            if (!$this->conn) {
                $error = oci_error();
                die("Error de conexión: " . $error['message']);
            }
        }

        public function getConn() {
            return $this->conn; 
        }

        public function close() {
            oci_close($this->conn);
        }
    }


    /* 
        ----- Ejemplo de Ejecutar consultas (DML + DDL) ------

        $db = new OracleDB();

        // SELECT
        $sql  = "SELECT idUsuario, nombreUsuario, correo FROM Usuario";
        $stmt = oci_parse($db->getConn(), $sql);
        oci_execute($stmt); 
        oci_free_statement($stmt); -> libera memoria

        $db->close();  
    */

?>