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

      static public function getByVorname($vorname) {
        $sql = new SelectQuery(self::$tableName, self::class);
        $sql->where("vorname = ?", $vorname);
        $results = $sql->execute();
        return $results;

      }

      public static function getLoginSuccessUrl() {
        return Url::find("backend-user");
      }


      public function __toString()
      {
          return $this->vorname.' '.$this->nachname;
      }

    }
