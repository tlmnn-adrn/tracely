<?php

    abstract class Model{

        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $dbName = 'tracely';

        private $pdo;

        public function __construct(){
            
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $this->pdo = new PDO($dsn, $this->user, $this->password):

        }

        protected function statement($sql, $values){

            $statement = $this->pdo->prepare($sql);

            if($statement->execute($values)){
                return $statement;
            }else{
                include('sql_error.php');
                die();
            }
            
        }

        protected function output($sql, $values){

            $statement = $this->statement($sql, $values):
            return $statement->fetchAll();

        }

        protected function insert($sql, $values){

            $statement = $this->statement($sql, $values):
            return $this->pdo->lastInsertId();

        }

    }