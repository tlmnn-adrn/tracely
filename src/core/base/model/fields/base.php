<?php

        // Beschreiben der Funktionen, die alle Felder haben müssen
        interface Field{

            public function get();
            public function setValue($value);
            public function updateValue($value, $unique);
            public function equals($value);
            public function isUnique();
            public function hasErrors();
            public function render($name);

        }

        class BaseField implements Field{

            protected $value;

            protected $errors = [];
            protected $errorTypes;

            protected $template = "text.php";

            function __construct(protected $required=FALSE, protected $unique=FALSE){

                //Laden der Fehlermeldungen aus der seperaten Datei errors.php
                //Speichern der Fehlermeldung in einem Attribut der Klasse, welches auch für Unterklassen zugänglich ist
                //So können alle Unterklassen auf dieselben Fehlermeldungen zugreifen
                //Um den Text einer Fehlermeldung zu ändern muss nur die Datei errors.php bearbeitet werden
                require 'core/base/model/fields/errors.php';
                $this->errorTypes = $errorTypes;
            }

            //Ausgabe des Wertes
            function get(){
                return $this->value;
            }

            //Setzen des Wertes
            //Wird verwendet, wenn der Wert aus der Datenbank geladen wird und in das Feld geschrieben werden soll
            //Wird auch von der Funktion updateValue verwendet, die diese Funktion nur aufruft, nachdem der neue Wert auf Gültigkeit überprüft wurde
            function setValue($value){
                $this->value = $value;
            }

            //Überprüfen des neuen Wertes auf Gültigkeit
            function checkValid($value){

                //Sollte das Feld Required sein, die Eingabe ist aber leer, gibt es eine Fehlermeldung beim anzeigen des Feldes
                if($this->required && strlen($value) == 0){

                    $this->errors[] = $this->errorTypes['requiredButEmptyError'];

                    return FALSE;
                }

                return True;

            }

            //Überschreiben eines Wertes
            //Dabei wird zuerst überprüft, ob der neue Wert gültig ist
            function updateValue($value, $unique){

                if($this->unique && !$unique){

                    $this->errors[] = $this->errorTypes['notUniqueError'];
                    return FALSE;
                }

                if($this->checkValid($value)){
                    $this->setValue($value);
                    return TRUE;
                }

                return FALSE;

            }

            //Ausgabe des Attributes unique
            function isUnique(){
                return $this->unique;
            }

            //Es wird ausgegeben, ob der gespeicherte Wert mit dem eingegebenen übereinstimmt
            function equals($value){
                return($value==$this->value);
            }

            //Es wird ausgegeben, ob es einen oder mehrere Versuche gab, das Feld mit einem ungültigen Wert zu überschreiben
            function hasErrors(){
                return count($this->errors)>0;
            }

            //Rendern des input Feldes
            function render($name, $placeholder="", $class=""){

                //Aufrufen des dazugehörigen Templates und anzeigen
                $path = 'core/base/model/fields/templates/'.$this->template;
                require($path);

            }

        }
