<?php

    class ForeignKeyField extends IntegerField implements Field{

        protected $options = [];

        protected $template = "foreignKey.php";

        function __construct(protected $model='', $required=FALSE, $unique=FALSE){

            parent::__construct($required, $unique);

        }


        //Überprüfen des neuen Wertes auf Gültigkeit
        function checkValid(){

            if(!$this->model::getById($this->value, FALSE)){

                $this->errors[] = $this->errorTypes['foreignKeyDoesntExist'];
            }

            return parent::checkValid($this->value);

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

        function render($name, $placeholder='', $class='', $errorClass=''){

            $options = $this->list();

            //Aufrufen des dazugehörigen Templates und anzeigen
            $path = 'core/base/model/fields/templates/'.$this->template;
            require($path);

        }
    }
