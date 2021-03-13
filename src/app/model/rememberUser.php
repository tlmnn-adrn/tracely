<?php
#Model für die Erinnerung der dauerhaufen Anmeldung einer Privatperson
    class RememberUserModel extends RememberAuthModel{

      static $tableName = "RememberBenutzer";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'authId' => new IntegerField(required: TRUE),
          'token' => new TextField(required: TRUE),
        ];

        parent::__construct($values);

      }

    }
