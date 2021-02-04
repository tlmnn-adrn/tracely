<?php

    abstract class Controller{

        protected $template;

        protected $templatePath = "app/template/";
        protected $templateMobilePath = "app/templateMobile/";

        protected $urlPatterns;
        protected $url;

        abstract protected function get($request);
        abstract protected function post($request);

        //Beim Aufruf wird unterschieden, ob es sich um einen GET oder einen POST request handelt
        //Es wird dann die entsprechende Funktion der Unterklasse aufgerufen
        public function __construct($urlPatterns, $url, $arguments){

            $this->urlPatterns = $urlPatterns;
            $this->url = $url;

            //Laden aller verwendeten Mixins
            //Aufrufen der Init Funktionen des Mixins
            //Init Funktion der Mixins 'Mixin' heißt 'mixinInit'
            foreach(class_uses($this) as $mixin){
                $functionName = lcfirst($mixin).'Init';

                if(method_exists($this, $functionName)){
                    $this->$functionName($arguments);
                }
                    
            }


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->post($_POST, ...$arguments);
            }else{
                $this->get($_GET, ...$arguments);
            }
        }

        //Rendern eines Templates
        //$context sind die Variablen, die in das Template eingefügt werden
        protected function render($context=[]){

            //Wenn die Seite von einem Hany aufgerufen wird, wird ein anderes Template angezeigt, sollte dies vorhanden sein
            if($this->isMobile() && file_exists('app/templateMobile/'.$this->template)){
                $path = $this->templateMobilePath.$this->template;
            }else{
                $path = $this->templatePath.$this->template;
            }

            extract($context);
            require($path);

        }

        //Überprüfung, ob von einem Handy aufgerufen
        //Quelle: https://www.geeksforgeeks.org/how-to-detect-a-mobile-device-using-php/
        protected function isMobile(){
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" , $_SERVER["HTTP_USER_AGENT"]);
        }

        protected function extend($template){

            $path = 'app/template/'.$template;
            return $path;

        }

        protected function link($link) {
          return "http://".$_SERVER['HTTP_HOST']."/".$link;
        }

        protected function url($name, ...$arguments){

            if(array_key_exists($name, $this->urlPatterns)){
                $path = $this->urlPatterns[$name]->getUrl($arguments);

                for($i=0; $i<count($this->url); $i++){
                    $path = '../'.$path;
                }

                return $path;
            }

        }

    }
