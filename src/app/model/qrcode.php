<?php
#Model für QR-Code
    class QrcodeModel extends AuthModel{

      static $tableName = "QrCode";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'code' => new TextField(required: TRUE),
          'tischnummer' => new IntegerField(required: TRUE),
          'sitzplätze' => new IntegerField(required: TRUE),
          'institutionId' => new ForeignKeyField(model:'InstitutionModel', required:TRUE),
        ];

        parent::__construct($values);

      }

      //Funktion die alle QR-Codes einer Institution zurückgibt
      //dies erfolgt durch die Übergabe der Institutions ID
      public static function getQrcodes($institutionId) {
        //erzeugt neue Instanz der Klasse SelectQuery
        $sql = new SelectQuery(static::$tableName, get_called_class());
        //ruft die Funktion where auf, um eine Bedingung für die SQL-Abfrage zu formulieren
        //Bedingung hier: das Datenfeld institutionId muss dem übergebenen Parameter entsprechen
        $sql->where('institutionId=?', $institutionId);
        //ruft die Funktion order auf, um nach einem bestimmten Datenfeld zu sortieren
        //hier: aufsteigend nach Datenfeld tischnummer
        $sql->order('tischnummer');
        //führe das SQL-Statement aus und weiße den Rückgabewert der Funktion execute der Variable qrcodes zu
        $qrcodes = $sql->execute();

        //gebe die Variable qrcode zurück
        return $qrcodes;
      }

      //Funktion, um einen Qr-Code anhand seines Codes zurückzugeben
      public static function getQrcodeByCode($code) {

        $sql = new SelectQuery(static::$tableName);
        //ruft die Funktion join auf, um eine Beziehung zwischen zwei Tabellen bzw. den Datensätzen aufzubauen
        //hier (1.): verknüpfe die Tablle Institution anhand des Primärschlüssels
        //und dem Fremdschlüssel in der Tabelle QrCode
        $sql->join('Institution', static::$tableName.'.institutionId = Institution.id');
        $sql->join('Institutionsart', 'Institution.institutionsartId = Institutionsart.id');

        $sql->where('code=?', $code);
        $qrcode = $sql->execute();

        return $qrcode;
      }

    }
