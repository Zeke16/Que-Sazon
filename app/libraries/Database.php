<?php
    class Database{
        //Se asignan las constantes, definidas en CONFIG.PHP, a las propiedades de la clase
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;
        private $dbPort = DB_PORT;

        //Se declaran 3 propiedades, 2 de ellas necesarias para ejecutar las consultas ($statement y $dbHandler)
        private $statement;
        private $dbHandler;
        //Propiedad reservada para capturar un error existente
        private $error;

        public function __construct(){
            //Se crea un string, formado por la información correspondiente al host; utilizando el host, puerto y base de datos
            $conn = "pgsql:host=$this->dbHost;port=$this->dbPort;dbname=$this->dbName";
            //Se configuran los atributos de la conexión
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try {
                //Se completan los parámetros para la conexión; añadiendo la info del host, el nombre del usuario, contraseña y los atributos de conexión
                $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            } catch (PDOException $e) {
                //Si la conexión falla, se asigna un mensaje mensaje a la propiedad $error
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Primer paso para ejecutar una consulta (se prepara la consulta)
        public function query($sql){
            $this->statement = $this->dbHandler->prepare($sql);
        }

        //Segundo paso, se asigna un tipo (obligatorio) a valores que se incluirán en una consulta
        public function bind($parameter, $value, $type = null){
            //Según el tipo de valor, es el tipo PDO a utilizar
            switch(is_null($type)){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }

            //Finaliza la configuración de los valores
            $this->statement->bindValue($parameter, $value, $type);
        }

        //Tercer paso, ejecuta una consulta (este método jamás se ejecturá individualmente)
        public function execute(){
            return $this->statement->execute();
        }

        //Cuarto paso (opcional): Se utiliza esta función si se pretende obtener más de un registro
        public function resultSet(){
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        //Cuarto paso (opcional): Se utiliza esta función si se pretende obtener un único registro
        public function single(){
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        //Cuenta los registros obtenidos
        public function rowCount(){
            return $this->statement->rowCount();
        }
    }
?>