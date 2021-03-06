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

    //verschiedene Fehler

    #404 Fehler
    class NotFoundError extends BaseError {

      public function __construct($errorMessageX="") {
        parent::__construct("404", "Diese Seite konnte nicht gefunden werden.<br>".$errorMessageX, 404);
      }
    }

    #Input Fehler
    class InputError extends BaseError {

      public function __construct($errorMessageX="") {
        parent::__construct("Input", "Die Eingabe ist unvollständig.<br>".$errorMessageX, 404);
      }
    }

    #SQL Fehler
    class SQLError extends BaseError {

      public function __construct($errorMessageX="") {
        parent::__construct("SQL" ,$statement->errorInfo()[2]."<br>".$errorMessageX, 500);
      }
    }

    #500 Fehler
    class ServerError extends BaseError {

      public function __construct($errorMessageX="") {
        parent::__construct("500", "Mehr als ein Objekt entspricht dem Filter. Verwende einen anderen Filter oder die filteredList Methode!<br>".$errorMessageX, 500);
      }
    }
