Router
======

Zu finden in *index.php*

Methoden
--------

__construct
...........

Funktion
~~~~~~~~

Parsed dei Url, die aufgerufen wurde. Findet die dazugehörige Seite und ruft den entsprechenden Controller mit den angegebenen Argumenten auf.

Code
~~~~

.. code-block:: php

    public function __construct(){            

        $this->url = $this->parseUrl();

        $url = Url::match($this->url);

        if($url){
            $controller = $url->callController();
        }else{
            new BaseError("404", "Diese Seite wurde konnte nicht gefunden werden", 404);
        }

    }

parseUrl
........

Funktion
~~~~~~~~

Holt die aufgerufene Url aus dem Get-Request und teilt diese nach '/'.
Sollte es keine Url im Get request gegeben haben, wird '' aufgerufen, also die Index-Seite.

Code
~~~~

.. code-block:: php

    private function parseUrl(){

        $url='';

        if(isset($_GET['url'])){
            $url = $_GET['url']=='index.php' ? '' : $_GET['url'];
        }

        $short = rtrim($url, '/'); 
        $filtered = filter_var($short, FILTER_SANITIZE_URL); 
        $exploded = explode('/', $filtered);

        return $exploded;
    }