<?php

    class InstitutionModel extends AuthModel{

      static $tableName = "Institution";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'name' => new TextField(required: TRUE),
          'passwort' => new PasswordField(),
          'adresse' => new TextField(required: TRUE),
          'stadt' => new TextField(required: TRUE),
          'plz' => new PlzField(required: TRUE),
          'email' => new EmailField(required: TRUE, unique:TRUE),
          'institutionsartId' => new ForeignKeyField(model:'InstitutionsartModel', required:TRUE),
        ];

        parent::__construct($values);

      }

    }
