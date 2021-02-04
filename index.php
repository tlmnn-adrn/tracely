<?php

    session_start();
    require_once 'core/requires.php';

    class Router{

        private $urlPatterns;
        private $url;
        private $controller;
        private $arguments=[];

        public function __construct(){

            require('core/urls.php');
            
            $this->urlPatterns = $urlPatterns;

            $this->url = $this->parseUrl();

            $this->controller = $this->findUrl();
            $controller = new $this->controller($this->urlPatterns, $this->url, $this->arguments);
        }

        private function parseUrl(){

            $url='';

            if(isset($_GET['url'])){
                $url = $_GET['url'];
            }

            $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
            $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
            $exploded = explode('/', $filtered);

            return $exploded;
        }

        private function findUrl(){

            //Vergleichen jedes Array_keys mit der URL
            foreach($this->urlPatterns as $urlPattern){

                //Stimmen sie überein, wird die Suche beednet und die Controller Klasse zurückgegeben
                $arguments = $urlPattern->matches($this->url);

                if(is_array($arguments)){
                    $this->arguments = $arguments;
                    return($urlPattern->getController());
                }
            }

            //Sollte die Seite nicht registriert sein, wird mit einer 404 Seite geantwortet
            new BaseError("404", "Diese Seite wurde konnte nicht gefunden werden", 404);
            
        }

    }

    $router = new Router();
