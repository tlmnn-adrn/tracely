
Model
=====

Attribute
---------

pdo
...

*Typ:          PDO*

*Sichtbarkeit: Private*

*Static:       Ja*

Hier wird die PDO Instanz gespeichert.

tableName
.........

*Typ:          String*

*Sichtbarkeit: Protected*

*Static:       Ja*

Hier wird der Tabellenname eines Modells gespeichert.

fields
.........

*Typ:          Array*

*Sichtbarkeit: Protected*

*Static:       Nein*

Die Spalten der Tabelle. Der Key des jeweiligen Feldes sollte dem Namen der Spalte genau entsprechen. Das id Feld wird automatisch hinzugefügt.

Methoden
--------

__constructStatic
.................

Funktion
~~~~~~~~

Stellt die Verbindung mit der Datenbank her. Wir zu diesem Zweck am Anfang des Programms aufgerufen.

Code
~~~~

.. code-block:: php

    public static function __constructStatic(){

        $dsn = 'mysql:host='.$_ENV['DBhost'].';dbname='.$_ENV['DBname'].';charset=utf8';
        self::$pdo = new PDO($dsn, $_ENV['DBuser'], $_ENV['DBpassword']);

    }

statement
.........

Parameter
~~~~~~~~~

*$sql: String* - Der SQL Befehl, als prepared Statement

*$values: Array* - Die Werte, die in das prepared Statement eingetragen werden sollen

Funktion
~~~~~~~~

Führt den als *$sql* übergebenen Query mit dem Array *$values* als Werte aus.

Code
~~~~

.. code-block:: php

    protected static function statement($sql, $values=[]){

        $statement = self::$pdo->prepare($sql);

        if($statement->execute($values)){
            return $statement;
        }else{
            new BaseError("SQL", $statement->errorInfo()[2], 500);
        }

    }

list
....

Funktion
~~~~~~~~

Returnt Array mit allen Zeilen der Tabelle.
Die Zeilen wurden dabei schon in Objekte der dazugehörigen Model-Klasse geschrieben.

Code
~~~~

.. code-block:: php

    public static function list(){

        $results = [];

        $statement = self::statement('SELECT * FROM '.static::$tableName);

        while($row = $statement->fetch()) {
            $object = new static($row);
            $results[] = $object;
        }

        return $results;

    }

filtered_list
.............

Parameter
~~~~~~~~~

*$filter: String* - Der WHERE Teil des sql Statements, als prepared Statement

*$filter_values: Array* - Die Werte, die in das WHERE Statement eingetragen werden

Funktion
~~~~~~~~

Returnt Array mit allen Zeilen der Tabelle, die dem Filter entsprechen.
Die Zeilen wurden dabei schon in Objekte der dazugehörigen Model-Klasse geschrieben.

Code
~~~~

.. code-block:: php

    protected static function filtered_list($filter, $filter_values){

        $results = [];
        $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

        while($row = $statement->fetch()) {
            $object = new static($row);
            $results[] = $object;
        }

        return $results;

    }

get
...

Parameter
~~~~~~~~~

*$filter: String* - Der WHERE Teil des sql Statements, als prepared Statement

*$filter_values: Array* - Die Werte, die in das WHERE Statement eingetragen werden

*$error (TRUE): Bool* - Stellt ein, ob eine 404 Meldung angezeigt werden soll, wenn die Seite nicht gefunden wurde


Funktion
~~~~~~~~

Returnt genau eine Zeile der Tabelle, welches dem Filter entspricht.
Die Zeile wurde dabei schon in ein Objekt der dazugehörigen Klasse geschrieben.
Sollte es kein oder mehr als ein Objekt geben, welches dem Filter entspricht, kann es je nach Einstellung zu einem 404-Fehler kommen.

Code
~~~~

.. code-block:: php

    protected static function get($filter, $filter_values, $error=TRUE){

        $results = [];
        $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

        $rowCount = $statement->rowCount();

        if($rowCount==1){
            $row = $statement->fetch();
            $object = new static($row);

            return $object;
        }

        if($error){
            if($rowCount<1){
                new BaseError("404", "Diese Seite wurde konnte nicht gefunden werden", 404);
            }else{
                new BaseError("500", "Mehr als ein Objekt entspricht dem Filter. Verwende einen anderen Filter oder die filteredList Methode!", 500);
            }
        }

        return NULL;


    }

getById
.......

Parameter
~~~~~~~~~

*$id: Int* - Die Id des zu findenden Objektes

Funktion
~~~~~~~~

Returnt das Objekt der Tabelle mit der angegebenen id.

Code
~~~~

.. code-block:: php

    public static function getById($id, $error=TRUE) {
        $filter = 'id = ?';
        $values = [$id];

        return static::get($filter, $values, $error);
    }

__construct
...........

Parameter
~~~~~~~~~

*$values ([]): Array* - Ein Array mit schon vorhandenen Wertenm welche als Werte in die Felder eingetragen werden.

Funktion
~~~~~~~~

Fügt zuerst ein IdField unter dem Key id hinzu. Dann werden die als Parameter
übergebenen Werte in die Felder eingetragen.

Code
~~~~

.. code-block:: php

    public function __construct($values=[]){

        $this->fields['id'] = new IdField();

        foreach(array_keys($this->fields) as $field){

            $this->fields[$field]->setValue($values[$field]??'');

        }

    }


__toString()
............

Funktion
~~~~~~~~

Beschreibt, wie das Objekt zu einem String umgewandelt werden soll.

Code
~~~~

.. code-block:: php

    public function __toString()
    {
        return $this->getField('id');
    }

getField
........

Parameter
~~~~~~~~~

*$field: String* - Das Feld, dessen Wert ausgegeben werden soll

Funktion
~~~~~~~~

Returnt den Wert eines Feldes

Code
~~~~

.. code-block:: php

    public function getField($field){

        return $this->fields[$field]->get();

    }

valueUnique
...........

Parameter
~~~~~~~~~

*$field: String* - Das Feld, das überprüft werden soll

*$value: String* - Der Wert, auf den das Feld überprüft werden soll

Funktion
~~~~~~~~

Überprüft, ob es in der Tabelle schon eine andere Reihe mit diesem Wert in dieser Spalte gibt.

Code
~~~~

.. code-block:: php

    private function valueUnique($field, $value){

        $statement = static::statement("SELECT * FROM ".static::$tableName." WHERE ".$field."=?", [$value]);
        $rowCount = $statement->rowCount();

        if($rowCount == 1){
            return $this->fields[$field]->equals($value);
        }elseif($rowCount > 1){
            return FALSE;
        }

        return TRUE;

    }

setField
........

Parameter
~~~~~~~~~

*$field: String* - Das Feld, dessen Wert geändert werden soll

*$value: String* - Der Wert auf den das Feld gesetzt werden soll

*...$params: Parameterliste* - Weitere Parameter

Funktion
~~~~~~~~

Überprüft zuerst, wenn das Feld *unique* ist, ob es den Wert schon irgendwo anders in dieser Tabelle gibt.
Ist dies nicht der Fall, wirddie Funktion updateValue eds zu ändernden Feldes aufgerufen, welche den Wert im Feld ändert.

Code
~~~~

.. code-block:: php

    public function setField($field, $value, ...$params){

        $unique = True;

        if($this->fields[$field]->isUnique()){
            if(!$this->valueUnique($field, $value)){
                $unique = FALSE;
            }
        }

        $success = $this->fields[$field]->updateValue($value, $unique, ...$params);

    }

renderField
...........

Parameter
~~~~~~~~~

*$field: String* - Das Feld, welches angezeigt werden soll

*...$params: Parameterliste* - Weitere Parameter

Funktion
~~~~~~~~

Lässt das Input-Feld als HTML anzeigen. Dies vereinfacht das Erstellen einer *form*.

Code
~~~~

.. code-block:: php

    public function renderField($field, ...$params){

        $this->fields[$field]->render($field, ...$params);

    }

setFieldOptions
...............

Parameter
~~~~~~~~~

*$field: String* - Das Feld, dessen Optionsliste geändert werden soll

*$options: Array* - Die Optionsliste, die gesetzt werden soll

Funktion
~~~~~~~~

Ruft, wenn das Feld die Methode *setOptions* hat, diese auf und setzt somit die Optionen, die man bei dem Feld auswählen kann.
Die kann zum Beispiel beim ForeignKeyField verwendet werden, um die Auswahl einzuschränken.

Code
~~~~

.. code-block:: php
    
    public function setFieldOptions($field, $options){

        if(method_exists($this->fields[$field], 'setOptions')){
            return $this->fields[$field]->setOptions($options);
        }

    }

hasErrors
.........

Funktion
~~~~~~~~

Überprüft, ob es beim setzen eines Feldes irgendwo einen Fehler gab.

Code
~~~~

.. code-block:: php

    protected function hasErrors(){

        foreach($this->fields as $field){
            if($field->hasErrors()){
                return TRUE;
            }
        }

        return FALSE;

    }

update
......

Parameter
~~~~~~~~~

*$force (FALSE): Bool* - Soll auch geupdatet werden, wenn versucht wurde einen ungültigen Wert in ein Feld einzutragen?

Funktion
~~~~~~~~

Updated die Reihe in der SQL-Tabelle mit den neuen, über setField gesetzten Werten.

Code
~~~~

.. code-block:: php

    public function update($force=FALSE){

        if($this->hasErrors() && !$force){
            return FALSE;
        }

        $sql = "UPDATE ".static::$tableName." SET ";
        $values = [];

        foreach(array_keys($this->fields) as $field){
            $sql .= $field."=?,";
            $values[] = $this->fields[$field]->get();
        }

        $sql = rtrim($sql, ',');

        $sql .= " WHERE id=?";
        $values[] = $this->fields['id']->get();

        $success = static::statement($sql, $values);
        return TRUE;

    }

create
......

Parameter
~~~~~~~~~

*$force (FALSE): Bool* - Soll die Zeile auch erstellt werden, wenn versucht wurde einen ungültigen Wert in ein Feld einzutragen?

Funktion
~~~~~~~~

Trägt eine neue Zeile mit den Werten der Felder in die Datenbank ein.

Code
~~~~

.. code-block:: php

    public function create($force=FALSE){

        if($this->hasErrors() && !$force){
            return FALSE;
        }

        $columns = "";
        $value_spaces = "";
        $values = [];

        foreach(array_keys($this->fields) as $field){

            if($field != 'id'){
                $columns .= $field.", ";
                $value_spaces .= "?, ";

                $values[] = $this->fields[$field]->get();
            }

        }

        $columns = rtrim($columns, ', ');
        $value_spaces = rtrim($value_spaces, ', ');

        $sql = "INSERT INTO ".static::$tableName." (".$columns.") VALUES (".$value_spaces.")";

        $success = static::statement($sql, $values);
        return TRUE;

    }