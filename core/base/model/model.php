<?php

    abstract class Model{

        //Festlegen der Verbindungsangaben zur Datenbank

        static $pdo;

        static $tableName;

        public static function __constructStatic(){

            //Beim Inkludieren einer Unterklasse wird diese Methode aufgerufen
            //Stellt die Verbindung zur Datenbank her
            $dsn = 'mysql:host='.$_ENV['DBhost'].';dbname='.$_ENV['DBname'].';charset=utf8';
            self::$pdo = new PDO($dsn, $_ENV['DBuser'], $_ENV['DBpassword']);

        }

        //Ausführen eines SQL Querys in der Datenbank
        protected static function statement($sql, $values=[]){

            $statement = self::$pdo->prepare($sql);

            if($statement->execute($values)){
                return $statement;
            }else{
                //Ist ein Fehler passiert, wird dieser angezeigt
                new BaseError("SQL", $statement->errorInfo()[2], 500);
            }

        }


        //Anzeigen aller Objekte in der Tabelle der aufrufenden Unterklasse
        public static function list(){

            $results = [];

            //SQL Statement, welches alles ausgeben lässt
            $statement = self::statement('SELECT * FROM '.static::$tableName);

            //Jedes Ergebnis wird zu einer *Modell-Klasse gemappt
            while($row = $statement->fetch()) {
                $object = new static($row);
                $results[] = $object;
             }

             return $results;

        }

        //Anzeigen einiger Objekte in der Tabelle der aufrufenden Unterklasse
        //Wie list() nur mit einem WHERE im SQL Statement
        protected static function filtered_list($filter, $filter_values){

            $results = [];
            $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

            while($row = $statement->fetch()) {
                $object = new static($row);
                $results[] = $object;
             }

             return $results;

        }

        //Anzeigen eines Objektes in der Tabelle der aufrufenden Unterklasse
        //Wie die filtered_list, nur dass es nur ein Ergebnisobjekt geben darf
        protected static function get($filter, $filter_values){

            $results = [];
            $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

            $rowCount = $statement->rowCount();

            //Gibt es nicht genau ein Objekt, welches die Bedingung erfüllt, wird eine Fehlermeldung angezeigt
            if($rowCount==1){
                $row = $statement->fetch();
                $object = new static($row);

                return $object;
            }elseif($rowCount<1){
                new BaseError("404", "Diese Seite wurde konnte nicht gefunden werden", 404);
            }else{
                new BaseError("500", "Mehr als ein Objekt entspricht dem Filter. Verwende einen anderen Filter oder die filteredList Methode!", 500);
            }


        }



        //------------------------------Non-Static------------------------------

        protected $fields;

        //Erstellen der Klasse
        //Laden aller gegebenen Werte
        public function __construct($values=[]){

            foreach(array_keys($this->fields) as $field){

                if(array_key_exists($field, $values)){
                    $this->fields[$field]->setValue($values[$field]);
                }

            }

        }

        public function getField($field){

          return $this->fields[$field]->get();

        }

        //Überprüfen, ob der Wert schon irgendwo in der Tabelle vorhanden ist
        //TRUE, wenn noch nicht vorhanden
        //FALSE, wenn vorhanden
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

        //Überschreiben des Wertes eines Feldes
        //Dabei wird überprüft, ob die neue Eingabe gültig ist
        //Ist sie nicht gültig, wird das Feld nicht überschrieben und eine Fehlermeldung wird angezeigt
        public function setField($field, $value, ...$params){

            $unique = True;

            //Sollte das Feld 'unique' sein, wird überprüft, ob es schon eine andere Zeile in der Datenbank gibt, die in dieser Spalte den Wert hat
            if($this->fields[$field]->isUnique()){
                if(!$this->valueUnique($field, $value)){
                    $unique = FALSE;
                }
            }

            $success = $this->fields[$field]->updateValue($value, $unique, ...$params);

        }

        //Ausgabe eines Feldes als input
        //Schneller Weg, um die Form zu erzeugen
        public function renderField($field, ...$params){

            $this->fields[$field]->render($field, ...$params);

        }

        //Funktion, um zu überprüfen, ob es beim Überschreiben der Werte eines Feldes einen Fehler gab
        protected function hasErrors(){

            foreach($this->fields as $field){
                if($field->hasErrors()){
                    return TRUE;
                }
            }

            return FALSE;

        }

        //Funktion, um die Reihe in der Datenbank entsprechend neu gesetzten Werte zu updaten
        //Standartmäßig wird das Updaten nicht durchgefürht, wenn es einen Versuch gabm einen ungültigen Wert in ein Feld zu schreiben
        //Dies kann mit dem Parameter $force=TRUE aber überschrieben werden
        //Ist es überschrieben, werden natürlich nur die Felder mit gültigen Werten überschrieben
        public function update($force=FALSE){

            //Sollte es den Versuch gegeben haben, einen ungültigen Wert in ein Feld zu setzen und das updaten wird nicht geforct, wird das updaten abgebrochen
            if($this->hasErrors() && !$force){
                return FALSE;
            }

            //Vorbereiten des sql statements und der übergebenen Werte
            $sql = "UPDATE ".static::$tableName." SET ";
            $values = [];

            foreach(array_keys($this->fields) as $field){
                $sql .= $field."=?,";
                $values[] = $this->fields[$field]->get();
            }

            //Entfernen des letzen Kommas, denn dieses würde sonst zu einem Fehler führen
            $sql = rtrim($sql, ',');

            $sql .= " WHERE id=?";
            $values[] = $this->fields['id']->get();

            //Ausführen des sql Befehls zum Überschreiben
            $success = static::statement($sql, $values);
            return TRUE;

        }

        //Äquivalent zu update, aber hier wird ein neuer Datensatz in die Tabelle eingefügt
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

    }
