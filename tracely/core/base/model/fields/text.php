<?php

    class TextField extends BaseField implements Field{

        protected $maxLength;

        protected $template = "text.php";

        function __construct($value='', $required=FALSE, $unique=FALSE, $maxLength=255){

            $this->maxLength = $maxLength;
            return parent::__construct($value, $required, $unique);
            
        }

        function checkValid($value){

            if(strlen($value)>$this->maxLength){

                $this->errors[] = $this->errorTypes['toLongError'];

                return FALSE;
            }

            return parent::checkValid($value);

        }

    }