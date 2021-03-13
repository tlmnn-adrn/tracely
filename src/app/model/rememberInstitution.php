<?php
#Model für die Erinnerung der dauerhaufen Anmeldung einer Institution
    class RememberInstitutionModel extends RememberAuthModel{

      static $tableName = "RememberInstitution";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'authId' => new IntegerField(required: TRUE),
          'token' => new TextField(required: TRUE),
        ];

        parent::__construct($values);

      }

    }
