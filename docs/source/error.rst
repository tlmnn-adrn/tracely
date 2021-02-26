
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

*$errorTitle: String* - Der Titel, der bei der Fehlermeldung angezeigt werden soll
(Standardwert: 404)

*$errorMessage: String* - Die Fehlernachricht

*$responseCode: Int* - Der http_response_code
(Standardwert: 404)

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



NotFoundError, SQLError, ServerError
=========

Extends Controller

Beschreibung
---------

*NotFoundError:* Erzeuge einen Fehler, wenn Seite nicht gefunden wurde (Fehler: 404)

*SQLError:* Erzeuge einen Fehler, wenn SQL Schnittstelle hervorbringt (Fehler: SQL)

*ServerError:* Erzeuge einen Fehler, wenn ein Fehler seitens des Server auftritt (Fehler: 500)



Methoden
--------

__Construct
...........

Parameter
~~~~~~~~~

*$errorMessageX: String* - mögliche Erweiterung der Fehlernachricht


Funktion
~~~~~~~~~

Ruft den Konstruktor der Elternklasse mit den gewünschten Werten für die Parameter auf.


Code am Beispiel: NotFoundError
~~~~

.. code-block:: php

    public function __construct($errorMessageX="") {
      parent::__construct("404", "Diese Seite konnte nicht gefunden werden.<br>".$errorMessageX, 404);
    }
