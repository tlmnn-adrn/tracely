<?php

    class TimeField extends BaseField{

        protected $template = "time.php";

        function checkValid(){

            //Überprüfung, ob die Datei wirklicj eine Zeit ist
            //Quelle https://stackoverflow.com/questions/14504913/verify-valid-date-using-phps-datetime-class/14505065
            if(DateTime::createFromFormat('h:m:s', $this->value) == FALSE){
                return FALSE;
            }

            return parent::checkValid();

        }

    }
