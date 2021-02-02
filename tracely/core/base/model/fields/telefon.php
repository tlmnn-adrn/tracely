<?php

    class TelefonField extends BaseField implements Field{

        protected $length = 13;

        protected $template = "text.php";

        function checkValid($value){

            if(strlen($value) != $this->length){

                $this->errors[] = $this->errorTypes['notAPhoneNumberError'];

                return False;
            }

            //Quelle: https://www.xspdf.com/resolution/56792114.html -- Abschnitt Php regex international phone number

            if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $value)){

                $this->errors[] = $this->errorTypes['notAPhoneNumberError'];
                
                return False;
            }

            return parent::checkValid($value);

        }

    }