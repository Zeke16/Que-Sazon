<?php 
    class Core {
        //Propiedades con valores por defecto, a utilizar si el usuario proporciona rutas no existentes
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        //Array vacío, donde se capturarán valores necesarios para alguna función (ejemplo, el ID de un producto)
        protected $params = [];

        public function __construct(){
            //Cada vez que se ejecutre el constructor (automáticamente cuando se crea un objeto de esta clase), se asignará un valor a $url (si existe una ruta proporcionada por el usuario) gracias al método getUrl()
            $url = $this->getUrl();

            //Si existe la posición cero del array, buscará si existe el controlador (ejemplo: www.QuéSazón.com/{book} <- controlador a buscar)
            if(isset($url[0])){
                if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                    $this->currentController = ucwords($url[0]);
                    //Elimina la variable dentro del array
                    unset($url[0]);
                }

                //Si existe la posición uno en el array, buscará el método dentro del controlador (ejemplo: www.QuéSazón.com/book/{update} <- método a buscar)
                if(isset($url[1])){
                    if(method_exists($this->currentController, $url[1])){
                        $this->currentMethod = $url[1];
                        //Elimina la variable dentro del array
                        unset($url[1]);
                    }
                }
            }

            //Sea si existe o no un controlador válido para buscar, se implementará su código (ejemplo: Book si existe dentro de la carpeta CONTROLLERS; Pages si no ha sido encontrado el controlador Book)
            require_once '../app/controllers/'.$this->currentController.'.php';
            $this->currentController = new $this->currentController;

            //Si existe una url ingresada por el usuario, regresará esta en forma de array. Si no, será un array vacío
            $this->params = $url ? array_values($url) : [];
            //Buscará el controlador, seguido del método, y proporcionará $params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            //Si el usuario (o el programador) continúa la url (a partir de quesazon/), se ejecutará el resto del código
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
            return [];
        }
    }
?>