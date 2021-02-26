<?php

    class InstitutionsartModel extends Model{

      static $tableName = "Institutionsart";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'name' => new TextField(required:TRUE, unique:TRUE),
          'aufenthaltszeit' => new IntegerField(required:TRUE),
        ];

        parent::__construct($values);

      }

      public function __toString(){
          return $this->name.' - '.$this->aufenthaltszeit.' min';
      }

    }
