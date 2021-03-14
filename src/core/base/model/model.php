<?php

    abstract class Model{

        //Festlegen der Verbindungsangaben zur Datenbank

        protected static $tableName;

        //Anzeigen aller Objekte in der Tabelle der aufrufenden Unterklasse
        public static function list(){

            $results = [];

            //SQL Statement, welches alles ausgeben lässt
            $query = new SelectQuery(static::$tableName, static::class);
            $results = $query->execute();

            return $results;

        }

        //Ausgabe der Instanz des Modells mit der angegebenen ID 
        public static function getById($id, $error=TRUE) {

            //Abfrage an die Datenbank
            $query = new SelectQuery(static::$tableName, static::class);
            $query->where('id=?', $id);
            $result = $query->execute();

            //Sollte es kein Datensatz mit dieser ID geben und die Fehlermeldung nicht ausgeschaltet sein, wird eine Fehlermeldung angezeigt
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

        //Wird aufgerufen, wenn strval($model) aufgerufen wird
        //Standartmäfig wird dann die id zurückgegeben
        public function __toString()
        {
            return $this->id;
        }

        //Wird aufgerufen, wenn man ein nicht definiertes oder geschütztes Attribut der Klasse aufrufen will
        //Wird verwendet, damit die Werte von Feldern der Klasse direkt aufgerufen werden können
        public function __get($key){

            //Überprüfung, ob das Modell ein Feld mit dem angegebenen Key hat
            //Ist dies der Fall, wird der Wert des Feldes ausgegeben
            if(array_key_exists($key, $this->fields)){
                return $this->fields[$key]->get();
            }

        }

        //Äquivalent zu __get(), nur dass hier der Wert geändert werden soll
        public function __set($key, $value){

            if(array_key_exists($key, $this->fields)){
                return $this->fields[$key]->set($value);
            }

        }

        //Ausgabe eines Feldes als input
        //Schneller Weg, um die Form zu erzeugen
        public function renderField($field, ...$params){

            $this->fields[$field]->render($field, ...$params);

        }

        //Festlegen der Auswahloptionen eines ForeignKeyFeldes
        //Dabei wird auch überprüft, ob es sich wirklich um ein ForeigKeyFeld handelt
        public function setFieldOptions($field, $options){

            if(method_exists($this->fields[$field], 'setOptions')){
                return $this->fields[$field]->setOptions($options);
            }

        }

        //Funktion zum ändern des Passwortes bei einem Passwortfeld
        //Dabei wird auch überprüft, ob es sich um wirklich um ein Passwortfeld handelt
        public function setPassword($field, ...$params){

            if(method_exists($this->fields[$field], 'setPassword')){
                return $this->fields[$field]->setPassword(...$params);
            }

        }

        //Überprüfung, ob, wenn das Feld unique ist, ob es schno einen anderen Datensatz mit diesem Wert in diesem Feld gibt
        protected function hasUniqueError($fieldKey, $field){

            //Überprüfung, ob das Feld unique sein soll
            //Wenn nicht, gibt es definitiv keinen unique Error
            if(!$field->unique){
                return FALSE;
            }

            //Ausgabe aller Datensätze, mit diesem Wert in diesem Feld
            $sql = new SelectQuery(static::$tableName, static::class);
            $sql->where($fieldKey.'=?', $field->get());
            $results = $sql->execute();

            //Gibt es mehr als einen Datensatz mit dem Wert, ist die unique Bedingung definitiv nicht erfüllt
            //(Und irgendwas anderes ist schief gegangen)
            if(count($results)>1){
                return TRUE;
            }

            //Gibt es genau einen anderen Datensatz mit diesem Wert in dem Feld, wird überprüft, ob es sich um den zu änderten Datensatz handelt
            //In diesem Fall ist die Bedingung erfüllt, sonst gibt es einen unique Error
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

        //Äquivalent zu update, aber hier wird ein Datensatz aus der Tabelle gelöscht
        public function delete(){

            $sql = "DELETE FROM ".static::$tableName." WHERE id = ?";
            $values = [$this->id];
            $query = new BaseQuery();
            $success = $query->executeStatement($sql, $values);
            return TRUE;

        }

    }
