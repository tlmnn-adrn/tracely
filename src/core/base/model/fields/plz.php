<?php

    class PlzField extends BaseField{

        protected $template = 'text.php';

        function checkValid(){

            //Überprüfung, ob die Postleitzahl auch wirklich genau 5 Stellen lang ist
            if(strlen($this->value)!=5){
                $this->errors[] = $this->errorTypes['plzError'];
            }

            //Überprüfung, ob die Eingabe auch wirklich numerisch ist
            //Quelle: https://stackoverflow.com/questions/48496291/check-if-string-only-contains-numbers-in-php
            if (!preg_match('/^[0-9]+$/', $this->value)){
                $this->errors[] = $this->errorTypes['textInNumberFieldError'];
            }

            return parent::checkValid();

        }

    }