<?php

    require_once('404.php');

    class Router{

        private $url_patterns;
        private $url;
        private $controller;
        private $arguments=[];

        public function __construct(){

            require_once('urls.php');
            $this->url_patterns = $url_patterns;

            $this->url = $this->parseUrl();

            $this->controller = $this->findUrl();
            $controller = new $this->controller($this->arguments);
        }

        private function parseUrl(){

            if(isset($_GET['url'])){
                $url = $_GET['url'];
                $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
                $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
                $exploded = explode('/', $filtered);

                return $exploded;
            }

        }

        private function parseUrlPattern($url){
            $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
            $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
            $exploded = explode('/', $filtered);

            return $exploded;
        }

        private function findUrl(){

            //Vergleichen jedes Array_keys mit der URL
            foreach(array_keys($this->url_patterns) as $url_pattern){
                //Parsen der URL im URL Pattern
                $parsed_url_pattern = $this->parseUrlPattern($url_pattern);

                //Stimmen sie überein, wird die Suche beednet und die Controller Klasse zurückgegeben
                if($this->matches($parsed_url_pattern, $this->url)){
                    return($this->url_patterns[$url_pattern]);
                }
            }

            //Sollte die Seite nicht registriert sein, wird mit einer 404 Seite geantwortet
            throw_404();
            
        }

        //Überprüfen, ob die URL dem Pattern entspricht
        private function matches($pattern, $url){

            $arguments = [];

            //Enthalten die Patterns unterschiedlich viele Elemente, können sie nicht übereinstimmen
            if(count($pattern) != count($url)){
                return 0;
            }

            $len = count($pattern);

            //Die einzelnen Elemente werden miteinander verglichen
            for($i=0; $i<$len; $i++){

                //Stimmen zwei Elemente nicht miteinander überein, wird überprüft, ob das Element des Patterns ein Argument ist
                if($pattern[$i] != $url[$i]){
                    
                    //Argumente werden im Pattern im Stil <*> angegeben
                    //Handelt es sich bim Element des Patterns um ein Argument, ist es egal, dass die Elemente nicht übereinstimmen
                    //Dann wird das Argument mit seinem Wert im Array $arguments gespeichert, so dass später darauf zugegriffen werden kann
                    //Handelt es sich nicht um ein Argument, stimmen die Pattern nicht überein 
                    if($pattern[$i][0] == '<' && $pattern[$i][-1] == '>'){
                        $arguments[trim($pattern[$i], '<>')] = $url[$i];
                    }else{
                        return 0;
                    }
                }
            }
            
            //Stimmen die Pattern überein, werden die Argumente in einem Attribut der Klasse gespeichert, so dass sie auch von anderen Methoden verwendet werden können
            $this->arguments = $arguments;

            return 1;
        }

    }

    $router = new Router();