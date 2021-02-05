<?php

    class UserModel extends AuthModel{

      static $tableName = "Benutzer";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'telefonnummer' => new TelefonField('', TRUE, FALSE),
          'passwort' => new PasswordField('', 6),
          'email' => new EmailField('', TRUE, TRUE),
          'vorname' => new TextField('', TRUE, TRUE, 255),
          'nachname' => new TextField('', TRUE, FALSE, 255),
          'plz' => new PlzField('', TRUE, FALSE)

        ];

        parent::__construct($values);

      }


      public function __toString() 
      {    
          return $this->getField('vorname').' '.$this->getField('nachname'); 
      } 

    }
