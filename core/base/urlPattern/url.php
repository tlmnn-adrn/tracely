<?php

    class Url{


        //------------------------- Static -------------------------

        protected static $urlPatterns;
        
        public static function add($name, ...$arguments){

            self::$urlPatterns[$name] = new static(...$arguments);
            
        }

        public static function find($name, ...$arguments){

            if(array_key_exists($name, self::$urlPatterns)){
                return self::$urlPatterns[$name]->getUrl($arguments);
            }

        } 

        public static function match($url){

            //Vergleichen jedes Array_keys mit der URL
            foreach(self::$urlPatterns as $urlPattern){

                //Stimmen sie überein, wird die Suche beednet und die Controller Klasse zurückgegeben
                $arguments = $urlPattern->matches($url);

                if(is_array($arguments)){
                    $urlPattern->setArgs($arguments);
                    return $urlPattern;
                }
            }

            return FALSE;

        }


        //------------------------- Non-Static -------------------------

        protected $url;
        protected $controller;
        protected $name;

        protected $arguments;

        public function __construct($url, $controller){

            $this->url = $this->parseUrl($url);
            $this->controller = $controller;

        }

        protected function parseUrl($url){
            $short = rtrim($url, '/'); //Entfernen des letzten / falls vorhanden
            $filtered = filter_var($short, FILTER_SANITIZE_URL); //Entfernt in der URL nicht zugelassene Zeichen
            $exploded = explode('/', $filtered);

            return $exploded;
        }

        //Überprüfen, ob die URL dem Pattern entspricht
        public function matches($url){

            $arguments = [];

            $len = count($this->url);

            //Enthalten die Patterns unterschiedlich viele Elemente, können sie nicht übereinstimmen
            if($len != count($url)){
                return FALSE;
            }

            //Die einzelnen Elemente werden miteinander verglichen
            for($i=0; $i<$len; $i++){

                //Stimmen zwei Elemente nicht miteinander überein, wird überprüft, ob das Element des Patterns ein Argument ist
                if($this->url[$i] != $url[$i]){
                    
                    //Argumente werden im Pattern im Stil <*> angegeben
                    //Handelt es sich bim Element des Patterns um ein Argument, ist es egal, dass die Elemente nicht übereinstimmen
                    //Dann wird das Argument mit seinem Wert im Array $arguments gespeichert, so dass später darauf zugegriffen werden kann
                    //Handelt es sich nicht um ein Argument, stimmen die Pattern nicht überein 
                    if($this->isArg($this->url[$i])){
                        $arguments[trim($this->url[$i], '<>')] = $url[$i];
                    }else{
                        return FALSE;
                    }
                }
            }
            
            //Stimmen die Pattern überein, werden die Argumente in einem Attribut der Klasse gespeichert, so dass sie auch von anderen Methoden verwendet werden können
            $this->arguments = $arguments;

            return $arguments;
        }

        public function setArgs($arguments){
            $this->arguments = $arguments;
        }

        public function callController(){
            return new $this->controller($this->arguments);
        }

        protected function isArg($element){
            if(strlen($element) >= 1 && $element[0] == '<' && $element[-1] == '>'){
                return TRUE;
            }
            return FALSE;
        }

        public function getUrl($arguments=[]){

            $path = "http://".$_SERVER['HTTP_HOST']."/";
            $argument_counter = 0;

            foreach($this->url as $element){
                if($this->isArg($element) && array_key_exists($argument_counter, $arguments)){
                    $path .= $arguments[$argument_counter];
                    $argument_counter++;
                }else{
                    $path .= $element.'/';
                }
            }

            $path = rtrim($path, '/');

            return $path;
        }

    }