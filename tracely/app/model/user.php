<?php

    require_once '../core/base/model/model.php';
    require_once '../core/base/model/fields.php';

    class UserModel extends Model{

      static $tableName = "Benutzer";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'id' => new IntegerField('', TRUE, TRUE),
          'telefonnummer' => new TelefonField('', TRUE, FALSE),
          'passwort' => new PasswordField('', 6),
          'email' => new EmailField('', TRUE, TRUE),
          'vorname' => new TextField('', TRUE, FALSE, 255),
          'nachname' => new TextField('', TRUE, FALSE, 255),
          'plz' => new PlzField('', TRUE, FALSE)

        ];

        parent::__construct($values);

      }

      public static function getById($id) {
        $filter = 'id = ?';
        $values = [$id];

        return static::get($filter, $values);
      }

    }
