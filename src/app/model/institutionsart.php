<?php
#Model für Institutionsart, erbt von der Klasse Model
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

      //Formulierung eines Strings der Werte für die Attribute Name und Aufenthaltszeit
      //des entsprechenden Objektes beinhaltet
      public function __toString(){
          return $this->name.' - '.$this->aufenthaltszeit.' min';
      }

    }
