<?php
    class Controller{
        //Esta función permite invocar el archivo correspondiente al modelo (clase) incluido en el parámetro $MODEL, y a su vez, permite crear una instancia (objeto) de la clase al asignar el valor en una variable
        public function model($model){
            require_once '../app/models/'.$model.'.php';
            return new $model;
        }

        //Incluye dos parámetros: $view (la vista a invocar) y  un arreglo de datos - $data - (información proveniente de la base de datos, o lo que se desee incluir)
        public function view($view, $data = []){
            if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die("View doesn't exists");
            }
        }
    }
?>