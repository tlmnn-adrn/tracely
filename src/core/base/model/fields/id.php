<?php

    class IdField extends IntegerField implements Field{

        function __construct($value=''){
    
            $this->value = $value;
            $this->required = TRUE;
            $this->unique = TRUE;

            //Laden der Fehlermeldungen aus der seperaten Datei errors.php
            //Speichern der Fehlermeldung in einem Attribut der Klasse, welches auch für Unterklassen zugänglich ist
            //So können alle Unterklassen auf dieselben Fehlermeldungen zugreifen
            //Um den Text einer Fehlermeldung zu ändern muss nur die Datei errors.php bearbeitet werden
            require 'core/base/model/fields/errors.php';
            $this->errorTypes = $errorTypes;
        }

        function updateValue($value, $unique){

            $this->errors[] = $this->errorTypes['setIdError'];

            return FALSE;

        }

    }