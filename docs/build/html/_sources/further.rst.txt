Weiteres im source-Ordner
=========================

Seiten registrieren
-------------------

Das Registrieren neuer Seiten sollte in *core/urls.php* passieren.

Eine Seite registrieren
.......................

1. Den Controller, der zur Seite gehört, mit require_once importieren
2. Mit der folgenden Zeile die Url registrieren

.. code-block:: php

    Url::add('name der Seite', 'Url der Seite', 'Aufzurufender Controller');

Argumente in der Url
~~~~~~~~~~~~~~~~~~~~

In der Url können Argumente übergeben werden. Dies funktioniert ähnlich, wie ein Get-request.

.. code-block:: php

    Url::add('test', 'test/<nummer>', 'TestController');
    //Ruft man test/3 auf, wird der TestController mit dem Argument nummer=3 aufgerufen

Static Urls
~~~~~~~~~~~

Möchte man einen Ordner mit Bildern, Css, Js, ... - Dateien anlegen, sollte man StaticUrl verwenden.

.. code-block:: php

    StaticUrl::add('Name des Ordners', 'Pfad zum Ordner');

Modelle und Mixins importieren
..............................

Importe von Modellen und Mixins sollten in *requires.php* mit require_once erfolgen.

Server-Einstellungen
....................

Einstellungen, die alles auf dem Server betreffen findet man unter *settings.php*.
Die eingestellten Variablen sollten in Environment-Variablen gespeichert werden.

In *settings.php* findet man unter anderem die Einstellungen zur Verbindung mit der Datenbank.