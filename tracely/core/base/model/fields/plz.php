<?php

    class PlzField extends BaseField implements Field{

        protected $template = 'text.php';

        function checkValid($value){

            if(strlen($value)!=5){

                $this->errors[] = $this->errorTypes['plzError'];

                return FALSE;
            }

            //Quelle: https://stackoverflow.com/questions/48496291/check-if-string-only-contains-numbers-in-php
            if (!preg_match('/^[0-9]+$/', $value)){

                $this->errors[] = $this->errorTypes['textInNumberFieldError'];

                return FALSE;
            }

            return parent::checkValid($value);

        }

    }