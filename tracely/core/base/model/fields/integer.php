<?php

    class IntegerField extends BaseField implements Field{

        protected $template = "integer.php";

        function checkValid($value){

            if($required && $value == NULL){
                $this->errors[] =$this->errorTypes['requiredButEmptyError'];

                return FALSE;
            }

            if(!preg_match('/^[0-9]+$/', $value) && !is_int($value)){
                $this->errors[] = $this->errorTypes['textInNumberFieldError'];

                return FALSE;
            }

            return True;

        }

    }