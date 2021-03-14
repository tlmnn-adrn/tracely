<?php

    //Klasse für den static folder, in dem css und js Dateien gespeicjert werden
    class StaticUrl extends Url{

        public function __construct($url){

            $this->url = $this->parseUrl($url);

        }
        
        //Ausgabe der URL einer Datei im static Ordner
        public function getUrl($arguments=[]){

            $path = "https://".$_SERVER['HTTP_HOST']."/";
            $path .= implode('/', $this->url).'/'.$arguments[0];
            
            return $path;
        }

    }