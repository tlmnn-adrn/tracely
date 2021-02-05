<?php

    class InstitutionsartModel extends Model{

      static $tableName = "Institutionsart";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'name' => new TextField('', TRUE, TRUE, 255),
          'aufenthaltszeit' => new IntegerField('', TRUE, FALSE),
        ];

        parent::__construct($values);

      }

      public function __toString(){
          return $this->getField('name').' - '.$this->getField('aufenthaltszeit').' min';
      }

    }
