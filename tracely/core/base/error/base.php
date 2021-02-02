<?php

    //Fehler Klasse
    //Ähnlich wie Controller Klasse, das extenden lohnt sich aber nicht, da alle überschrieben wird

    class BaseError{

        //Festlegen des Templates, welches gezeigt wird und die Fehlermeldung enthält
        protected $template = "base.php";

        //Die Funktion render wird direkt im __construct aufgerufen
        //Der Fehlertitel, Die Fehlernachricht und der Fehlercode können spezifiziert werden
        public function __construct($errorTitle="404", $errorMessage="", $responseCode=404){
            
            $this->render($errorTitle, $errorMessage, $responseCode);

        }

        protected function render($errorTitle, $errorMessage, $responseCode){

            //Die Fehlermeldung wird angezeigt
            $path = 'core/base/error/templates/'.$this->template;
            require($path);

            //Quelle: https://stackoverflow.com/questions/1381123/how-can-i-create-an-error-404-in-php
            //Der Fehlercode wird als HTTP response Code übergeben
            //Danach wird das script abgebrochen
            http_response_code($responseCode);
            die();

        }

    }