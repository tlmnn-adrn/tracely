<?php

    class EmailField extends TextField implements Field{

        protected $template = "email.php";

        function checkValid($value){

            //Quelle: https://www.php.net/manual/de/filter.examples.validation.php
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){

                $this->errors[] = $this->errorTypes['invalidEmailError'];

                return FALSE;
            }

            return parent::checkValid($value);

        }

    }