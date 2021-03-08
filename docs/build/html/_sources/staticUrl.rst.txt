
StaticUrl
=========

extends Url

Methoden
--------

__construct
...........

Parameter
~~~~~~~~~

*$url: String* - Der Ort des Static-Ordners relativ zum Root-Ordner des Servers.

Code
~~~~

.. code-block:: php

    public function __construct($url){

        $this->url = $this->parseUrl($url);

    }

getUrl
......

Parameter
~~~~~~~~~

*$arguments([]): Array* - Arguments[0] enthält den Ort des statischen Elements relativ zum Static-Ordners

Funktion
~~~~~~~~

Returnt die Url unter der das angegebene Element gefunden werden kann.

Code
~~~~

.. code-block:: php

    public function getUrl($arguments=[]){

        $path = "http://".$_SERVER['HTTP_HOST']."/";
        $path .= implode('/', $this->url).'/'.$arguments[0];
            
        return $path;
    }
