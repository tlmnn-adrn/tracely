<?php

    class SelectQuery extends BaseQuery{

        private $pdo;

        private $where = [];
        private $whereValues = [];

        private $orderBy = [];
        private $orderValue = [];

        private $joins = [];

        public function __construct(
            private $table,
            private $model = '',
        ){

            parent::__construct();

        }

        public function execute(){

            $sql = 'SELECT * FROM '.$this->table.$this->formulateWhere().$this->formulateJoin().$this->formulateOrder();
            $values = $this->whereValues;

            $statement = $this->executeStatement($sql, $values);

            if(strlen($this->model)>0){
                $statement->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->model);
            }

            return $statement->fetchAll();

        }

        public function where($condition, $value){

            $this->where[] = $condition;

            if(is_array($value)){
                $this->whereValues = array_merge($this->whereValues, $value);
            }else{
                $this->whereValues[] = $value;
            }

        }

        public function join($table, $condition, $type){

            $this->joins[] = [$table, $condition, $type];

        }

        public function order($column, $desc=FALSE){

            $this->orderBy[] = $column;
            $this->orderValue[] = $desc ? 'DESC' : 'ASC';

        }

        private function formulateWhere(){

            if(count($this->where) > 0){

                $sql = " WHERE ";
                $sql .= implode(' AND ', $this->where);

                return $sql;

            }

            return '';

        }

        private function formulateJoin(){

            $sql = " ";

            foreach($this->joins as $join){
              echo $join[2];
                switch($join[2]){

                    case 0:
                        $type = 'INNER JOIN';
                        break;

                    case 1:
                        $type = 'LEFT JOIN';
                        break;

                    case 2:
                        $type = 'INNER JOIN';
                        break;

                    default:
                        $type = 'INNER JOIN';

                }

                $sql .= $type.' '.$join[0].' ON '.$join[1].' ';

            }

            return $sql;

        }

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
