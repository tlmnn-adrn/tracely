<?php

    class TelefonField extends BaseField{

        protected $length = 14;

        protected $template = "text.php";

        function checkValid(){

            //Überprüfung, ob die Eingabe die genaue Länge einer Telefonnummer hat
            if(strlen($this->value) != $this->length){

                $this->errors[] = $this->errorTypes['notAPhoneNumberError'];

            } 

            //Quelle: https://www.xspdf.com/resolution/56792114.html -- Abschnitt Php regex international phone number
            //Überprüfung, ob die Eingabe eine Telefonnummer ist
            //Format: +4900000000000
            if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $this->value)){

                $this->errors[] = $this->errorTypes['notAPhoneNumberError'];
                
            }

            return parent::checkValid();

        }

    }