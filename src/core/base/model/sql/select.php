<?php

    //Select SQL Abfage
    class SelectQuery extends BaseQuery{

        //Liste von Where Filtern und den Werten dafür
        private $where = [];
        private $whereValues = [];

        //Liste von Spalten, nach den sortiert werden soll 
        private $orderBy = [];
        //Liste, ob jeweils aufsteigend oder absteigend sortiert weden soll
        private $orderValue = [];

        //Liste von Tabellen, mit denen gejoint werden soll
        private $joins = [];

        public function __construct(
            private $table,
            private $model = '',
        ){

            parent::__construct();

        }

        //Ausführen des SELECT statements
        public function execute(){

            //Zusammenfügen des Statements aus der Tabelle, den Joins, den Wheres und den Order Bys
            $sql = 'SELECT * FROM '.$this->table.$this->formulateJoin().$this->formulateWhere().$this->formulateOrder();
            $values = $this->whereValues;

            //Ausführen des Select statements
            $statement = $this->executeStatement($sql, $values);

            //Wenn ein Modell im Construct angegeben wurde, wird eine Instanz dieses Modells mit den Werten returnt
            //Sonst wird einfach ein Array zurückgegeben
            if(strlen($this->model)>0){
                $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->model);
            }

            //Zurückgabe der Ergebnisse
            return $statement->fetchAll();

        }

        //Hinzufügen einer Where Bedingung
        public function where($condition, $value){

            $this->where[] = $condition;

            if(is_array($value)){
                $this->whereValues = array_merge($this->whereValues, $value);
            }else{
                $this->whereValues[] = $value;
            }

        }

        //Hinzufügen eines Joins und der dazugehörigen Bedingung
        public function join($table, $condition){

            $this->joins[] = [$table, $condition];

        }

        //Hinzufügung einer Spalte, nach der sortiert werden soll und absteigend / aufsteigen
        public function order($column, $desc=FALSE){

            $this->orderBy[] = $column;
            $this->orderValue[] = $desc ? 'DESC' : 'ASC';

        }

        //Formulieren der Where Bedingungen als String
        private function formulateWhere(){

            //Where statement muss nur formuliert werden, wenn vorher irgendeine Where-Bedingung festgelegt wurde
            if(count($this->where) > 0){

                //Where Bedingung setzt sich WHERE und den Bedingungen zusammen
                $sql = " WHERE ";
                $sql .= implode(' AND ', $this->where);

                return $sql;

            }

            return '';

        }

        //Formulierung der JOINs, ähnlich wie WHERE
        private function formulateJoin(){

            $sql = " ";

            foreach($this->joins as $join){

                $type = 'LEFT JOIN';

                $sql .= $type.' '.$join[0].' ON '.$join[1].' ';

            }

            return $sql;

        }

        //Formulierung der ORDER BYs, ähnlich wie WHERE und JOIN
        private function formulateOrder(){

            if(count($this->orderBy)==0){
                return '';
            }

            $sql = ' ORDER BY ';

            for($i=0; $i<count($this->orderBy); $i++){
                $sql .= $this->orderBy[$i].' '.$this->orderValue[$i].', ';
            }

            $sql = rtrim($sql, ', ');

            return $sql;

        }


    }
