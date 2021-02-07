<?php

    class TextField extends BaseField implements Field{

        protected $template = "text.php";

        function __construct($required=FALSE, $unique=FALSE, protected $maxLength=255){

            return parent::__construct($required, $unique);
            
        }

        //Überprüfung, ob die Eingabe länger ist als zugelassen
        function checkValid($value){

            if(strlen($value)>$this->maxLength){

                $this->errors[] = $this->errorTypes['toLongError'];

                return FALSE;
            }

            return parent::checkValid($value);

        }

    }