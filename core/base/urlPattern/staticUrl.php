<?php

    class StaticUrl extends Url{

        public function __construct($url){

            $this->url = $this->parseUrl($url);

        }
        
        public function getUrl($arguments=[]){

            $path = "http://".$_SERVER['HTTP_HOST']."/";
            $path .= implode('/', $this->url).'/'.$arguments[0];
            
            return $path;
        }

    }