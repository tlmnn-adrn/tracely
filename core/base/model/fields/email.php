<?php

    class EmailField extends TextField implements Field{

        protected $template = "email.php";

        function checkValid($value){

            //Quelle: https://www.php.net/manual/de/filter.examples.validation.php
            //Es soll zusätzlich überprüft werden, ob es sich um eine gültige E-Mail Adresse handelt
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){

                $this->errors[] = $this->errorTypes['invalidEmailError'];

                return FALSE;
            }

            //Ansonsten übernimmt die Überprüfung der Gültigkeit die Elternklasse
            return parent::checkValid($value);

        }

    }