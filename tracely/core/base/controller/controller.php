<?php

    abstract class Controller{

        protected $template;

        abstract protected function get($request, $arguments);
        abstract protected function post($request, $arguments);

        //Beim Aufruf wird unterschieden, ob es sich um einen GET oder einen POST request handelt
        //Es wird dann die entsprechende Funktion der Unterklasse aufgerufen
        public function __construct($arguments){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->post($_POST, $arguments);
            }else{
                $this->get($_GET, $arguments);
            }
        }

        //Rendern eines Templates
        //$context sind die Variablen, die in das Template eingefügt werden
        protected function render($context=[]){

            $path = '../app/view/template/'.$this->template;
            require($path);

        }

        //Laden eines Modells
        protected function includeModel($modelName){

            $path = '../app/model/'.$modelName.'.php';
            require_once($path);

            $modelName = ucfirst($modelName).'Model';

            //Aufrufen der __constructStatic Methode, um die Verbindung mit der Datenbank herzustellen
            $modelName::__constructStatic();

        }
    }
