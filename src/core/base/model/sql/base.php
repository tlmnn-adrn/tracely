<?php

    //Grundlage für alle SQL Abfragen
    class BaseQuery{

        protected $pdo;

        public function __construct(){

            //Stellt die Verbindung zur Datenbank her
            $dsn = 'mysql:host='.$_ENV['DBhost'].';dbname='.$_ENV['DBname'].';charset=utf8';
            $this->pdo = new PDO($dsn, $_ENV['DBuser'], $_ENV['DBpassword']);

        }

        //Ausführen des SQL statements $sql mit den Werten $values
        public function executeStatement($sql, $values=[]){

            $statement = $this->pdo->prepare($sql);

            if($statement->execute($values)){
                return $statement;
            }else{
                //Ist ein Fehler passiert, wird dieser angezeigt
                throw new SQLError;
            }

        }

    }
