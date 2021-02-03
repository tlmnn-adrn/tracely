<?php

    class InstitutionModel extends AuthModel{

      static $tableName = "Institution";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'id' => new IntegerField('', TRUE, TRUE),
          'name' => new TextField('', TRUE, TRUE, 255),
          'passwort' => new PasswordField('', 6),
          'adresse' => new TextField('', TRUE, TRUE, 255),
          'stadt' => new TextField('', TRUE, TRUE, 255),
          'plz' => new PlzField('', TRUE, FALSE),
          'email' => new EmailField('', TRUE, TRUE),
          'institutionsartId' => new IntegerField('', TRUE, FALSE),
        ];

        parent::__construct($values);

      }

      public static function getById($id) {
        $filter = 'id = ?';
        $values = [$id];

        return static::get($filter, $values);
      }

    }
