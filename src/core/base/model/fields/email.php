<?php

    class EmailField extends TextField implements Field{

        protected $template = "email.php";

        function checkValid(){

            //Quelle: https://www.php.net/manual/de/filter.examples.validation.php
            //Es soll zusätzlich überprüft werden, ob es sich um eine gültige E-Mail Adresse handelt
            if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){

                $this->errors[] = $this->errorTypes['invalidEmailError'];

            }

            //Ansonsten übernimmt die Überprüfung der Gültigkeit die Elternklasse
            return parent::checkValid();

        }

    }