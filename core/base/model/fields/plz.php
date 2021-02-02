<?php

    class PlzField extends BaseField implements Field{

        protected $template = 'text.php';

        function checkValid($value){

            //Überprüfung, ob die Postleitzahl auch wirklich genau 5 Stellen lang ist
            if(strlen($value)!=5){

                $this->errors[] = $this->errorTypes['plzError'];

                return FALSE;
            }

            //Überprüfung, ob die Eingabe auch wirklich numerisch ist
            //Quelle: https://stackoverflow.com/questions/48496291/check-if-string-only-contains-numbers-in-php
            if (!preg_match('/^[0-9]+$/', $value)){

                $this->errors[] = $this->errorTypes['textInNumberFieldError'];

                return FALSE;
            }

            return parent::checkValid($value);

        }

    }