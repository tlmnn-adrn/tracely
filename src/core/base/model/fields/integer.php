<?php

    class IntegerField extends BaseField implements Field{

        protected $template = "integer.php";

        function checkValid(){

            //Überprüfung, ob das Feld leer ist und required ist
            if($this->required && $this->value == NULL){
                $this->errors[] =$this->errorTypes['requiredButEmptyError'];

            }

            //Überprüfung, ob die Eingabe auch wirklich nummerisch ist
            if(!preg_match('/^[0-9]+$/', $this->value) && !is_int($this->value)){
                $this->errors[] = $this->errorTypes['textInNumberFieldError'];

            }

            return parent::checkValid();

        }

    }
