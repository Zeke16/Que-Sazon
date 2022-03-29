<?php
    //Clase de prueba
    class User{
        private $db;

        //El constructor permite generar una conexión cada vez se instancie esta clase
        public function __construct() {
            $this->db = new Database;
        }

        //Prueba de funcionalidad
        public function getUsers(){
            $this->db->query("SELECT * FROM Users");

            $result = $this->db->resultSet();

            return $result;
        }
    }
?>