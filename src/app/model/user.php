<?php

    class UserModel extends AuthModel{

      static $tableName = "Benutzer";
      protected $fields = [];

      public function __construct() {
        $this->fields = [
          'telefonnummer' => new TelefonField(TRUE, FALSE),
          'passwort' => new PasswordField(6),
          'email' => new EmailField(TRUE, TRUE),
          'vorname' => new TextField(TRUE, FALSE, 255),
          'nachname' => new TextField(TRUE, FALSE, 255),
          'plz' => new PlzField(TRUE, FALSE)

        ];

        parent::__construct();

      }


      public function __toString()
      {
          return $this->vorname.' '.$this->nachname;
      }

    }
