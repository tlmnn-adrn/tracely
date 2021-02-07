<?php

    session_start();
    require_once 'core/requires.php';

    class Router{

        public function __construct(){            

            $url = $this->parseUrl();

            $page = Url::match($url);

            if($page){
                $controller = $page->callController();
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
