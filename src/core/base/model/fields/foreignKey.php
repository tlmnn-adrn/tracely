<?php

    class ForeignKeyField extends IntegerField implements Field{

        protected $model;
        protected $options = [];

        protected $template = "foreignKey.php";

        function __construct($value='', $model='', $required=FALSE, $unique=FALSE){

            $this->model = $model;

            parent::__construct($value, $required, $unique);

        }


        //Überprüfen des neuen Wertes auf Gültigkeit
        function checkValid($value){
            
            if(!$this->model::getById($value, FALSE)){
                $this->errors[] = $this->errorTypes['foreignKeyDoesntExist'];
                return FALSE;
            }

            return parent::checkValid($value);

        }

        protected function list(){

            if(count($this->options)>0){
                return $this->options;
            }

            return $this->model::list();

        }

        function setOptions($options=[]){

            $this->options = $options;

        }

        function render($name, $placeholder='', $class=''){

            $options = $this->list();

            //Aufrufen des dazugehörigen Templates und anzeigen
            $path = 'core/base/model/fields/templates/'.$this->template;
            require($path);

        }
    }
