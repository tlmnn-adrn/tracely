<?php

    class TextField extends BaseField{

        protected $template = "text.php";

        //Beim Construct wird das Attribut $this->maxLength hinzugefügt
        function __construct($required=FALSE, $unique=FALSE, protected $maxLength=255){

            return parent::__construct($required, $unique);
            
        }

        //Überprüfung, ob die Eingabe länger ist als zugelassen
        function checkValid(){

            if(strlen($this->value)>$this->maxLength){
                $this->errors[] = $this->errorTypes['toLongError'];
            }

            return parent::checkValid();

        }

    }