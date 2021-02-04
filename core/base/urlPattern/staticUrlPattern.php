<?php

    class StaticUrlPattern extends UrlPattern{

        public function __construct($url){

            $this->url = $this->parseUrl($url);

        }

        public function getUrl($arguments=[]){

            $path = implode('/', $this->url).'/'.$arguments[0];

            return $path;
        }

    }