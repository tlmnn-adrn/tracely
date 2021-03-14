<?php

    class DateField extends BaseField{

        protected $template = "date.php";

        function checkValid(){

            //Überprüfung, ob sich der Wert wirklich ein Datum ist
            //Quelle https://stackoverflow.com/questions/14504913/verify-valid-date-using-phps-datetime-class/14505065
            if(DateTime::createFromFormat('Y-m-d', $this->value) == FALSE){
                return FALSE;
            }

            return parent::checkValid();

        }

    }
