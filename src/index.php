<?php

    session_start();
    require_once 'core/requires.php';

    class Router{

        private $url;

        public function __construct(){            

            $this->url = $this->parseUrl();

            $url = Url::match($this->url);

            if($url){
                $controller = $url->callController();
            }else{
                new BaseError("404", "Diese Seite wurde konnte nicht gefunden werden", 404);
            }

        }

        private function parseUrl(){

            $url='';

            if(isset($_GET['url'])){
                $url = $_GET['url']=='index.php' ? '' : $_GET['url'];
            }

            $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
            $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
            $exploded = explode('/', $filtered);

            return $exploded;
        }

    }

    $router = new Router();
