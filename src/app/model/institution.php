<?php
#Model für Institution, erbt von der Klasse AuthModel
    class InstitutionModel extends AuthModel{

      //Definition des klassenspezifischen Tabellenbezeichners in der Datenbank
      static $tableName = "Institution";

      //Definition der Attribute in einem Array
      protected $fields = [];

      public function __construct($values=[]) {
        //Deklartion des dazugehörigen Feldes der einzelnen Attribute
        $this->fields = [
          'name' => new TextField(required: TRUE),
          'passwort' => new PasswordField(),
          'adresse' => new TextField(required: TRUE),
          'stadt' => new TextField(required: TRUE),
          'plz' => new PlzField(required: TRUE),
          'email' => new EmailField(required: TRUE, unique:TRUE),
          'institutionsartId' => new ForeignKeyField(model:'InstitutionsartModel', required:TRUE),
        ];

        //Aufruf des Konstruktors der Oberklasse AuthModel
        parent::__construct($values);

      }

      //gibt nach erfolgreichem Login die aufzurufende Url zurückgibt
      public static function getLoginSuccessUrl() {
        return Url::find("backend-institution");
      }

    }
