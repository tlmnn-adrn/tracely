<?php

    session_start();
    require_once 'core/requires.php';

    class Router{

        public function __construct(){

            //parst die aufgerufene URL
            $url = $this->parseUrl();

            //findet den zu der URL zugehörigen Controller
            $page = Url::match($url);

            //Ruft den Controller auf, wenn einer gefunden wurde, sonst 404 Seite
            if($page){
                $controller = $page->callController();
            }else{
                new NotFoundError;
            }

        }

        private function parseUrl(){

            $url='';

            //Bekommt die aufgerufene URL
            if(isset($_GET['url'])){
                $url = $_GET['url']=='index.php' ? '' : $_GET['url'];
            }

            $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
            $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
            $exploded = explode('/', $filtered); //zerteilt die aufgerufene URL in mehrere Elemente

            return $exploded;
        }

    }

    $router = new Router();
