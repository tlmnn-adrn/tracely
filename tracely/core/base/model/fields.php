<?php

    interface Field{

        public function get();
        public function setValue($value);
        public function updateValue($value);
        public function checkValid($value);
        public function equals($value);
        public function isUnique();

    }

    class BaseField implements Field{
        
        protected $value;
        protected $required;
        protected $unique;

        function __construct($value='', $required=FALSE, $unique=FALSE){

            $this->value = $value;
            $this->required = $required;
            $this->unique = $unique;

        }

        //Ausgabe des Wertes
        function get(){
            return $this->value;
        }

        function setValue($value){
            $this->value = $value;
        }

        function checkValid($value){

            if($this->required && strlen($value) == 0){
                return FALSE;
            }

            return True;

        }

        function updateValue($value){

            if($this->checkValid($value)){
                $this->setValue($value);
                return TRUE;
            }

            return FALSE;

        }

        function isUnique(){
            return $this->unique;
        }

        function equals($value){
            return($value==$this->value);
        }

    }

    class TextField extends BaseField implements Field{

        protected $maxLength;

        function __construct($value='', $required=FALSE, $unique=FALSE, $maxLength=255){

            $this->maxLength = $maxLength;
            return parent::__construct($value, $required, $unique);
            
        }

        function checkValid($value){

            if(strlen($value)>$this->maxLength){
                return FALSE;
            }

            return parent::checkValid($value);

        }

    }

    class EmailField extends TextField implements Field{

        function checkValid($value){

            //Quelle: https://www.php.net/manual/de/filter.examples.validation.php
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                return FALSE;
            }

            return parent::checkValid($value);

        }

    }

    class IntegerField extends BaseField implements Field{

        function checkValid($value){

            if($required && $value == NULL){
                return FALSE;
            }

            if(!preg_match('/^[0-9]+$/', $value) && !is_int($value)){
                return FALSE;
            }

            return True;

        }

    }

    class TelefonField extends BaseField implements Field{

        protected $length = 13;

        function checkValid($value){

            if(strlen($value) != $this->length){
                return False;
            }

            //Quelle: https://www.xspdf.com/resolution/56792114.html -- Abschnitt Php regex international phone number

            if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $value)){
                return False;
            }

            return parent::checkValid($value);

        }

    }

    class PlzField extends BaseField implements Field{

        function checkValid($value){

            if(strlen($value)!=5){
                return FALSE;
            }

            //Quelle: https://stackoverflow.com/questions/48496291/check-if-string-only-contains-numbers-in-php
            if (!preg_match('/^[0-9]+$/', $value)){
                return FALSE;
            }

            return parent::checkValid($value);

        }

    }

    class PasswordField extends BaseField implements Field{

        protected $minLength;
        
        function __construct($value='', $minLength=6){
            
            $this->minLength = $minLength;
            return parent::__construct($value, TRUE, FALSE);
            
        }

        function equals($value){

            if($this->value==""){
                return TRUE;
            }
            
            return password_verify($value, $this->value);
        }

        function checkValid($value){

            if(!$this->equals($value)){
                return False;
            }

            if(strlen($value)<$this->minLength){
                return FALSE;
            }

            return parent::checkValid($value);

        }

        function hash($value){
            return password_hash($value, PASSWORD_DEFAULT);
        }

        function updateValue($value){

            if($this->checkValid($value)){

                $value = $this->hash($value);
                $this->setValue($value);
                return TRUE;
            }

            return FALSE;

        }

    }