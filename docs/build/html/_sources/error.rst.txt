
BaseError
=========

Extends Controller

Attribute
---------

template
........

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Fehlermeldungs-Templates relativ zum Template-Ordner an

templatePath
............

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Ordners für Fehlermeldungs-Templates relativ zum root Ordner an.

templateMobilePath
..................

*Type: String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt den Pfad des Ordners für Fehlermeldungs-Templates für mobile Geräte relativ zum root Ordner an.


Methoden
--------

__Construct
...........

Parameter
~~~~~~~~~

*$errorTitle ("404"): String* - Der Titel, der bei der Fehlermeldung angezeigt werden soll

*$errorMessage (""): String* - Die Fehlernachricht

*$responseCode (404): Int* - Der http_response_code, z.B. 404

Funktion
~~~~~~~~

Zeigt die Fehlermeldung *errorMessage* und den Fehlertitel *errorTitle* an. Dann bricht es den weiteren Verlauf des Programms ab.


Quellen
~~~~~~~

*https://stackoverflow.com/questions/1381123/how-can-i-create-an-error-404-in-php*

Code
~~~~

.. code-block:: php

    public function __construct($errorTitle="404", $errorMessage="", $responseCode=404){
            
        $context = [
            "errorTitle" => $errorTitle,
            "errorMessage" => $errorMessage,
        ];

        $this->render($context);

            
        http_response_code($responseCode);
        die();

    }