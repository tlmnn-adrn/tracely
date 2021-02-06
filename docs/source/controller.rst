Controller
==========

Attribute
---------

template
........

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Templates relativ zum Template-Ordner an

templatePath
............

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Ordners für Templates relativ zum root Ordner an.

templateMobilePath
..................

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Ordners für Templates für mobile Geräte relativ zum root Ordner an.


Methoden
--------

__construct
...........

Parameter
~~~~~~~~~

*$arguments: Array* - Die in der URL übergebenen Parameter

Funktion
~~~~~~~~

Die Construct-Funktion führt zuerst die Init-Funktion aller Mixins aus, die eine haben.
Dann wird unterschieden, ob es einen Post- oder Get-request gab. Bei dem Post-request wird
die Funktion post() des Controllers aufgerufen. Bei einem Get-request die Funktion get();
Der aufgerufenen Funktion werden der Request und die in der URL enthaltenen Argumente übergeben.

Code
~~~~

.. code-block:: php

    public function __construct($arguments){

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

post und get
............

Parameter
~~~~~~~~~

*$request: Array* - *$_POST* oder *$_GET*

*...$arguments: Array* - Die in der URL übergebenen Parameter

Funktion
~~~~~~~~
Es handelt sich hierbei um abstrakte Funktionen.
Die Funktionen sollen dabei beschreiben, was passiert, wenn die Seite mit einem Post- / Get- Request aufgerufen wurde.

render
......

Parameter
~~~~~~~~~

*$context ([]): Array* - Die übergebenen Werte, welche in das Template eingetragen werden sollen

Funktion
~~~~~~~~

Zuerst wird der Pfad des Templates relativ zum root des Servers berechnet.
Dann entpackt die Funktion all Variablen aus dem Context, so dass sie mit ihrem Key als Variablennamen ansprechbar sind.
Als letztes wird die Template Seite aufgerufen und angezeigt.

Code
~~~~

.. code-block:: php

    protected function render($context=[]){

        $path = $this->extend($this->template);

        extract($context);
        require($path);

    }

isMobile
........

Funktion
~~~~~~~~

Diese Funktion unterscheidet, ob der Aufruf von einem Desktop oder einem mobilen Gerät kam.
Wurde sie von einem mobilen aufgerufen, returnt sie TRUE;

Quellen
~~~~~~~

*https://www.geeksforgeeks.org/how-to-detect-a-mobile-device-using-php/*


Code
~~~~

.. code-block:: php

    protected function isMobile(){
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" , $_SERVER["HTTP_USER_AGENT"]);
    }


extend
......

Parameter
~~~~~~~~~

*$template: String* - Der Ort des Templates relativ zum Template-Ordner

Funktion
~~~~~~~~

Zuerst unterscheidet die render-funktion, ob es die Seite von einem mobilen Gerät aufgerufen wurde.
Ist dies der Fall und ist für die Seite ein Template für mobile Geräte hinterlegt, wird der Pfad für
das mobile Template in die Variable *$path* geschrieben. Ansonsten wird der Pfad für das Desktop-Template
in diese Variable geschrieben.


Code
~~~~

.. code-block:: php

    protected function extend($template){

        if($this->isMobile() && file_exists('app/templateMobile/'.$template)){
            $path = $this->templateMobilePath.$template;
        }else{
            $path = $this->templatePath.$template;
        }

        return $path;

    }