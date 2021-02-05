
Erste Schritte
==============


Installation
------------

Anforderungen
.............

* Php Version 8.0+
* Eine SQL Datenbank

Installation
............

1. Dieses Github repository clonen: https://github.com/tlmnn-adrn/tracely
2. Den src Ordner in den Root deines Webservers kopieren
3. Die Details der Verbindung mit dem SQL Server in *core/settings.php* eintragen

Erstes Projekt
--------------

Die Erste Seite
...............

Das erste Projekt soll mit der Index-Seite begonnen werden.
Um eine neue Seite zu starten muss zuerst ein neuer Controller gestartet werden.
Die Controller sollten alle im Ordner *app/controller* erstellt werden.
Dort wird nun die neue Datei *home.php* erstellt.

In dieser Datei wird nun eine neue Klasse namens *HomeController* definiert.
Diese soll die Klasse Controller erweitern.

.. code-block:: php
    
    class HomeController extends Controller
    {

    }

Jeder Controller benötigt das Attribut $template.
Mit diesem Attribut kann festgelegt werden, welches Template von dem Controller gerendert wird.
Damit das Template auch vom Controller gefunden wird, sollte es sich im Ordner *app/template* befinden.
Der Pfad sollte relativ zum Ordner *app/template* angegeben werden.

.. code-block:: php

    protected $template = 'home.php';

Der angegebene Pfad sollte natürlich zu einer Datei verweisen.
Dafür wird nun die Datei *home.php* im Template Ordner erzeugt.

.. code-block:: html

    <html>
        <head></head>
        <body>
            <h1>Hallo Welt</h1>
        </body>
    </html>

Neben dem Attribut *template* benötigt der Controller noch 2 Methoden:
1. Die Funktion *get()*
2. Die Funktion *post()*

Beide mehmen als Attribut die Variable *$request*.
Die Funktion *get()* wird bei einem Get-request aufgerugen. Die Funktion Post bei einem Post-request.

.. code-block:: php
    
    class HomeController extends Controller
    {

        protected $template = 'home.php';

        protected function get($request) {
        }

        protected function post($request) {
        }
    }

Um das Template zu rendern muss am Ende der Methode die Funktion render der 
Klasse Controller aufgerufen werden.

.. code-block:: php
    
    class HomeController extends Controller
    {

        protected $template = 'home.php';

        protected function get($request) {
            $this->render();
        }

        protected function post($request) {
            $this->render();
        }
    }

Damit der Server die Seite nun findet, muss der Controller noch in *core/urls.php* registriert werden.
Dafür muss die entstandene Datei zunächst importiert werden. Dann wird die Seite im Array registriert.

.. code-block:: php
    
    require_once "app/controller/home.php";

    Url::add('index', '', 'HomeController');

In der zweiten Zeile werden dabei genau drei Parameter übergeben.

* Der erste Parameter ist ein Name für die registrierte Seite. Dieser ist für den Endnutzer der Seite unsichtbar. Dabei darf kein Name doppelt genutzt werden.
* Der zweite Parameter ist der Pfad der Seite. Da dies die Index Seite ist, wird ein leerer String übergeben.
* Der dritte Parameter ist der Controller, der aufgerufen werden soll, wenn der Nutzer die Seite aufruft.

Ruft man nun die URL des Servers auf, wird das Template angezeigt.

Daten an das Template übergeben
...............................

Es können Daten an das Template übergeben werden.
Dafür wird zuerst ein Array definiert, welcher hier *$context* heißen soll.
Die zu übergebenden Daten werden in diesen Array geschrieben.

.. code-block:: php

  $context = [
      "test" => "Dies ist ein Test",
  ]

Um die Daten für das Template zugänglich zu machen, müssen diese in der Funktion *render* übergeben werden.

.. code-block:: php

    $this->render($context);

Die übergebenen Daten erscheien nun im Template als Variablen mit dem angegebenem Key als Name.

.. code-block:: php

    <h1>Es wurden folgende Daten übergeben:</h1>
    <p><?=$test?></p>

Mit der Datenbank verbinden
...........................

Wenn die Installationsschritte befolgt wurden, sollte die Verbindung mit einer Datenbank bereits hergestellt sein.
Die Datei *settings.php* sollte ungefähr so aussehen

.. code-block:: php

    //Mysql Data
    $_ENV['DBhost'] = 'localhost';
    $_ENV['DBuser'] = 'root';
    $_ENV['DBpassword'] = '';
    $_ENV['DBname'] = 'testDb';

Ist dies der Fall, können nun Modelle geschrieben werden. Dabei sollte ein Modell genau einer Tabelle der Datenbank entsprechen.
Modelle sollten im Ordner *app/model* stehen.

Zuerst wird hier eine neue Datei *test.php* erstellt. In dieser wird nun die Klasse TestModel definiert.
Die Klasse sollte eine Unterklasse von Modell sein.

.. code-block:: php

    class TestModel extends Model{

    }

In der Klasse müssen nun zwei Sachen angegeben werden:

1. Der Name der Tabelle im Attribut *$tableName*
2. Die Spalten der Tabelle nach Datentyp. Die Spalten müssen in der *__construct* Funktion gesetzt werden. 
   Die *Id* Spalte muss dabei nicht übergeben werden. 
   Sie wird automatisch bei jedem Modell hinzugefügt.
   Die Keys der Felder sollten den Namen der Spalten in der Tabelle genau entsprechen.

.. code-block:: php

    class TestModel extends Model{

        static $tableName = "Test";
        protected $fields = [];

        public function __construct($values=[]) {
            $this->fields = [
                'name' => new TextField(),
                'anzahl' => new IntegerField(),
            ];

            parent::__construct($values);

        }

    }

Nun sollte die Modell-Datei in *core/requires.php* importiert werden.

.. code-block:: php

    //------------------------- App -------------------------

    //Model
    require_once 'app/model/test.php';
    TestModel::__constructStatic();

Um nun an eine Instanz der Klasse TestModel im Controller zu gelangen kann zum
Beispiel die statische Funktion *getById* der Klasse *Model* genutzt werden.

.. code-block:: php

    $object = TestModel::getById(2);

Alle modelle besitzen die Funktion getField. Mit dieser kann der Wert eines Feldes erhalten werden.
Übergibt man *$object* nun an das Template, könnte dies im Template so aussehen:

.. code-block:: php

    <p>Name:   <?=$object->getField('name')?></p>
    <p>Anzahl: <?=$object->getField('anzahl')?></p>