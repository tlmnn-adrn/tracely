<?php

        // Beschreiben der Funktionen, die alle Felder haben müssen
        interface Field{

            public function get();
            public function set($value);
            public function equals($value);
            public function hasErrors();
            public function render($name);
            public function checkValid();

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

            function __get($key){
                if($key=="unique"){
                    return $this->unique;
                }
            }

            //Ausgabe des Wertes
            function get(){
                return $this->value;
            }

            //Setzen des Wertes
            //Wird verwendet, wenn der Wert aus der Datenbank geladen wird und in das Feld geschrieben werden soll
            //Wird auch von der Funktion updateValue verwendet, die diese Funktion nur aufruft, nachdem der neue Wert auf Gültigkeit überprüft wurde
            function set($value){
                $this->value = $value;
            }

            //Überprüfen des neuen Wertes auf Gültigkeit
            function checkValid(){

                //Sollte das Feld Required sein, die Eingabe ist aber leer, gibt es eine Fehlermeldung beim anzeigen des Feldes
                if($this->required && strlen($this->value) == 0){

                    $this->errors[] = $this->errorTypes['requiredButEmptyError'];

                }

            }

            //Es wird ausgegeben, ob der gespeicherte Wert mit dem eingegebenen übereinstimmt
            function equals($value){
                return($value==$this->value);
            }

            //Es wird ausgegeben, ob es einen oder mehrere Versuche gab, das Feld mit einem ungültigen Wert zu überschreiben
            function hasErrors($uniqueError=FALSE){

                if($uniqueError){
                    $this->errors[] = $this->errorTypes['notUniqueError'];
                }

                $this->checkValid();

                return count($this->errors) > 0;
            }

            //Rendern des input Feldes
            function render($name, $placeholder="", $class="", $errorClass=""){

                //Aufrufen des dazugehörigen Templates und anzeigen
                $path = 'core/base/model/fields/templates/'.$this->template;
                require($path);

            }

        }
