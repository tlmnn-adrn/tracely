<?php

    class DateField extends BaseField implements Field{

        protected $template = "date.php";

        function checkValid(){

            //Quelle https://stackoverflow.com/questions/14504913/verify-valid-date-using-phps-datetime-class/14505065
            if(DateTime::createFromFormat('Y-m-d', $this->value) == FALSE){
                return FALSE;
            }

            return parent::checkValid();

        }

    }
