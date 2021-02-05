<?php

    class IntegerField extends BaseField implements Field{

        protected $template = "integer.php";

        function checkValid($value){

            //Überprüfung, ob das Feld leer ist und required ist
            if($this->required && $value == NULL){
                $this->errors[] =$this->errorTypes['requiredButEmptyError'];

                return FALSE;
            }

            //Überprüfung, ob die Eingabe auch wirklich nummerisch ist
            if(!preg_match('/^[0-9]+$/', $value) && !is_int($value)){
                $this->errors[] = $this->errorTypes['textInNumberFieldError'];

                return FALSE;
            }

            return True;

        }

    }
