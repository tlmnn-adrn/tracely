<?php

    class ForeignKeyField extends IntegerField{

        protected $options = [];

        protected $template = "foreignKey.php";

        //Hinzufügen des Modells, auf das der Foreign Key verweist
        function __construct(protected $model='', $required=FALSE, $unique=FALSE){

            parent::__construct($required, $unique);

        }


        //Überprüfen des neuen Wertes auf Gültigkeit
        function checkValid(){

            //Überprüfung, ob es den Datensatz gibt, auf das der Key verweisen soll
            if(!$this->model::getById($this->value, FALSE)){
                $this->errors[] = $this->errorTypes['foreignKeyDoesntExist'];
            }

            return parent::checkValid($this->value);

        }

        //Gibt eine Liste der möglichen Auswahlmöglilchkeiten aus
        protected function list(){

            //Wurden Ausgabemöglichkeiten von außen festgelegt, werden diese angezeigt
            if(count($this->options)>0){
                return $this->options;
            }

            //Sonst werden alle Datensätze des anderen Modells angezeigt
            return $this->model::list();

        }

        //Festlegen der Auswahlmöglichkeiten
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
