<?php

    class InstitutionModel extends AuthModel{

      static $tableName = "Institution";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'name' => new TextField('', TRUE, FALSE, 255),
          'passwort' => new PasswordField('', 6),
          'adresse' => new TextField('', TRUE, FALSE, 255),
          'stadt' => new TextField('', TRUE, FALSE, 255),
          'plz' => new PlzField('', TRUE, FALSE),
          'email' => new EmailField('', TRUE, TRUE),
          'institutionsartId' => new ForeignKeyField('', 'InstitutionsartModel', [], TRUE, FALSE),
        ];

        parent::__construct($values);

      }

    }
