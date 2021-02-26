<?php

    class UserModel extends AuthModel{

      static $tableName = "Benutzer";
      protected $fields = [];

      public function __construct() {
        $this->fields = [
          'telefonnummer' => new TelefonField(required:TRUE),
          'passwort' => new PasswordField(),
          'email' => new EmailField(required:TRUE, unique:TRUE),
          'vorname' => new TextField(required:TRUE),
          'nachname' => new TextField(required:TRUE),
          'plz' => new PlzField(required:TRUE),
        ];

        parent::__construct();

      }


      public function __toString()
      {
          return $this->vorname.' '.$this->nachname;
      }

    }
