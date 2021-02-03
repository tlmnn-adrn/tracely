<?php

    //Fehler Klasse

    class BaseError extends Controller{

        //Festlegen des Templates, welches gezeigt wird und die Fehlermeldung enthält
        protected $template = "base.php";

        protected $templatePath = "core/base/error/templates/";
        protected $templateMobilePath = "core/base/error/templatesMobile/";

        //Die Funktion render wird direkt im __construct aufgerufen
        //Der Fehlertitel, Die Fehlernachricht und der Fehlercode können spezifiziert werden
        public function __construct($errorTitle="404", $errorMessage="", $responseCode=404){
            
            $context = [
                "errorTitle" => $errorTitle,
                "errorMessage" => $errorMessage,
            ];

            $this->render($context);

            //Quelle: https://stackoverflow.com/questions/1381123/how-can-i-create-an-error-404-in-php
            //Der Fehlercode wird als HTTP response Code übergeben
            //Danach wird das script abgebrochen
            http_response_code($responseCode);
            die();

        }

        protected function get($request){}
        protected function post($request){}

    }