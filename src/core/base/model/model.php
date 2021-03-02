<?php

    abstract class Model{

        //Festlegen der Verbindungsangaben zur Datenbank

        /*private static $pdo;*/

        protected static $tableName;

        /*public static function __constructStatic(){

            //Beim Inkludieren einer Unterklasse wird diese Methode aufgerufen
            //Stellt die Verbindung zur Datenbank her
            $dsn = 'mysql:host='.$_ENV['DBhost'].';dbname='.$_ENV['DBname'].';charset=utf8';
            self::$pdo = new PDO($dsn, $_ENV['DBuser'], $_ENV['DBpassword']);

        }*/

        //Ausführen eines SQL Querys in der Datenbank
        /*protected static function statement($sql, $values=[]){

            $statement = self::$pdo->prepare($sql);

            if($statement->execute($values)){
                return $statement;
            }else{
                //Ist ein Fehler passiert, wird dieser angezeigt
                new SQLError;
            }

        }*/


        //Anzeigen aller Objekte in der Tabelle der aufrufenden Unterklasse
        public static function list(){

            $results = [];

            //SQL Statement, welches alles ausgeben lässt
            $query = new SelectQuery(static::$tableName, static::class);
            $results = $query->execute();

            return $results;

        }

        //Anzeigen einiger Objekte in der Tabelle der aufrufenden Unterklasse
        //Wie list() nur mit einem WHERE im SQL Statement
        /*protected static function filtered_list($filter, $filter_values){

            $results = [];
            $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

            while($row = $statement->fetch()) {
                $object = new static($row);
                $results[] = $object;
             }

             return $results;

        }*/

        //Anzeigen eines Objektes in der Tabelle der aufrufenden Unterklasse
        //Wie die filtered_list, nur dass es nur ein Ergebnisobjekt geben darf
        /*protected static function get($filter, $filter_values, $error=TRUE){

            $results = [];
            $statement = self::statement('SELECT * FROM '.static::$tableName.' WHERE '.$filter, $filter_values);

            $rowCount = $statement->rowCount();

            //Gibt es nicht genau ein Objekt, welches die Bedingung erfüllt, wird eine Fehlermeldung angezeigt
            if($rowCount==1){
                $row = $statement->fetch();
                $object = new static($row);

                return $object;
            }

            if($error){
                if($rowCount<1){
                    new NotFoundError;
                }else{
                    new ServerError;
                }
            }

            return FALSE;


        }*/

        public static function getById($id, $error=TRUE) {
            $query = new SelectQuery(static::$tableName, static::class);
            $query->where('id=?', $id);

            $result = $query->execute();

            if(count($result)!=1){

                if($error){
                    throw new ServerError;
                }

                return FALSE;
            }

            return $result[0];
        }

        //------------------------------Non-Static------------------------------

        protected $fields;

        //Erstellen der Klasse
        //Laden aller gegebenen Werte
        public function __construct(){

            $this->fields['id'] = new IdField();

        }

        public function __toString()
        {
            return $this->id;
        }

        public function __get($key){

            if(array_key_exists($key, $this->fields)){
                return $this->fields[$key]->get();
            }

        }

        public function __set($key, $value){

            if(array_key_exists($key, $this->fields)){
                return $this->fields[$key]->set($value);
            }

        }

        //Überprüfen, ob der Wert schon irgendwo in der Tabelle vorhanden ist
        //TRUE, wenn noch nicht vorhanden
        //FALSE, wenn vorhanden
        /*private function valueUnique($field, $value){

            $statement = static::statement("SELECT * FROM ".static::$tableName." WHERE ".$field."=?", [$value]);
            $rowCount = $statement->rowCount();

            if($rowCount == 1){
                return $this->fields[$field]->equals($value);
            }elseif($rowCount > 1){
                return FALSE;
            }

            return TRUE;


        }*/

        //Ausgabe eines Feldes als input
        //Schneller Weg, um die Form zu erzeugen
        public function renderField($field, ...$params){

            $this->fields[$field]->render($field, ...$params);

        }

        public function setFieldOptions($field, $options){

            if(method_exists($this->fields[$field], 'setOptions')){
                return $this->fields[$field]->setOptions($options);
            }

        }

        public function setPassword($field, ...$params){

            if(method_exists($this->fields[$field], 'setPassword')){
                return $this->fields[$field]->setPassword(...$params);
            }

        }

        public function hasUniqueError($fieldKey, $field){

            if(!$field->unique){
                return FALSE;
            }

            $sql = new SelectQuery(static::$tableName, static::class);
            $sql->where($fieldKey.'=?', $field->get());
            $results = $sql->execute();

            if(count($results)>1){
                return TRUE;
            }

            if(count($results)==1 && $results[0]->id != $this->id){
                return TRUE;
            }

            return FALSE;

        }

        //Funktion, um zu überprüfen, ob es beim Überschreiben der Werte eines Feldes einen Fehler gab
        public function hasErrors(){

            foreach(array_keys($this->fields) as $fieldKey){

                $field = $this->fields[$fieldKey];

                if($field::class != 'IdField' && $field->hasErrors($this->hasUniqueError($fieldKey, $field))){
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

            $query = new BaseQuery();
            $success = $query->executeStatement($sql, $values);
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

            $query = new BaseQuery();
            $success = $query->executeStatement($sql, $values);
            return TRUE;

        }

    }
