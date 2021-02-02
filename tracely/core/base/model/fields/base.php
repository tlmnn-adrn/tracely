<?php

        interface Field{

            public function get();
            public function setValue($value);
            public function updateValue($value, $unique);
            public function equals($value);
            public function isUnique();
            public function hasErrors();
            public function render($name);
    
        }
    
        class BaseField implements Field{
            
            protected $value;
            protected $required;
            protected $unique;

            protected $errors = [];
            protected $errorTypes;

            protected $template = "text.php";
    
            function __construct($value='', $required=FALSE, $unique=FALSE){
    
                $this->value = $value;
                $this->required = $required;
                $this->unique = $unique;


                require '../core/base/model/fields/errors.php';
                $this->errorTypes = $errorTypes;
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

                    $this->errors[] = $this->errorTypes['requiredButEmptyError'];

                    return FALSE;
                }
    
                return True;
    
            }
    
            function updateValue($value, $unique){
    
                if($this->unique && !$unique){

                    $this->errors[] = $this->errorTypes['notUniqueError'];
                    return FALSE;
                }

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

            function hasErrors(){
                return count($this->errors)>0;
            }

            function render($name, $placeholder="", $label="", $class=""){
                
                $path = 'base/model/fields/templates/'.$this->template;
                require($path);

            }
    
        }