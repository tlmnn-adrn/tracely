<?php

    abstract class Model{

        static $host = 'localhost';
        static $user = 'root';
        static $password = '';
        static $dbName = 'tracely';

        static $pdo;

        static $tableName;

        public static function __constructStatic(){
            
            //Beim Inkludieren einer Unterklasse wird diese Methode aufgerufen
            //Stellt die Verbindung zur Datenbank her
            $dsn = 'mysql:host='.self::$host.';dbname='.self::$dbName;
            self::$pdo = new PDO('mysql:host='.self::$host.';dbname='.self::$dbName, self::$user, self::$password);

        }

        //Ausführen eines SQL Querys in der Datenbank
        protected static function statement($sql, $values=[]){
            
            $statement = self::$pdo->prepare($sql);

            if($statement->execute($values)){
                return $statement;
            }else{
                //Ist ein Fehler passiert, wird dieser angezeigt
                include('sql_error.php');
                die();
            }

        }
        

        //Anzeigen aller Objekte in der Tabelle der aufrufenden Unterklasse
        protected static function list(){
        
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
                throw_404();
            }else{
                require_once('to_many_objects_error.php');
                throw_to_many_objects();
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

            try{
                return $this->fields[$field]->get();
            }catch(Throwable $t){
                return;
            }

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

        public function setField($field, $value){

            if($this->fields[$field]->isUnique()){
                if(!$this->valueUnique($field, $value)){
                    //error
                    return FALSE;
                }
            }

            $success = $this->fields[$field]->updateValue($value);

            if(!$success){
                //error
            }

        }

        public function update(){

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
            return $success;

        }

        public function create(){

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
            return $success;

        }

    }