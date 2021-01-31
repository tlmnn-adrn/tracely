<?php

    abstract class Controller{

        protected $template;
        protected $model;

        abstract protected function get($request, $arguments);
        abstract protected function post($request, $arguments);

        public function __construct($arguments){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->post($request=$_POST, $arguments);
            }else{
                $this->get($request=$_GET, $arguments);
            }
        }

        protected function render($context=[]){
            
            $path = '../app/view/template/'.$this->template;
            require($path);

        }

        protected function getModel($modelName, $modelPath){

            $path = '../app/model/'.$modelPath;
            require_once($path);

            $this->model = new $modelName();

        }
    }