<?php

    class BaseError{

        protected $template = "base.php";

        public function __construct($errorTitle="404", $errorMessage="", $responseCode=404){
            
            $this->render($errorTitle, $errorMessage, $responseCode);

        }

        protected function render($errorTitle, $errorMessage, $responseCode){

            $path = 'base/error/templates/'.$this->template;
            require($path);

            //Quelle: https://stackoverflow.com/questions/1381123/how-can-i-create-an-error-404-in-php

            http_response_code($responseCode);
            die();

        }

    }