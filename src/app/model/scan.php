<?php
#Model für Scan
    class ScanModel extends AuthModel{

      static $tableName = "Scan";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'qrCodeId' => new ForeignKeyField(model:'QrCodeModel', required:TRUE),
          'benutzerId' => new ForeignKeyField(model:'UserModel', required:TRUE),
          'tag' => new DateField(required: TRUE),
          'uhrzeit' => new TimeField(required: TRUE),
        ];

        parent::__construct($values);

      }

      //Funktion, die einen Scan nach der QR-Code ID gelöscht
      //wird benötigt, um Scans nach Löschen eines QR-Code zu löschen
      public static function deleteByCodeId($id) {
        $sql = "DELETE FROM ".static::$tableName." WHERE qrCodeId = ?";
        $values = [$id];
        $query = new BaseQuery();
        $success = $query->executeStatement($sql, $values);
        return TRUE;
      }

      //gibt alle Scans nach den jeweils gegebenen Parametern zurück
      public static function getScans($id, $tag, $tischnummer, $uhrzeit) {

        $sql = new SelectQuery(static::$tableName);
        $sql->join('Benutzer', static::$tableName.'.benutzerId = Benutzer.id');
        $sql->join('QrCode', static::$tableName.'.qrcodeId = QrCode.id');

        $sql->where('QrCode.institutionId=?', $id);

        //überprüft welche Parameter übergeben wurden und führt den entsprechenden Anweisungsblock aus
        if ($tag) {$sql->where(static::$tableName.'.tag=?', $tag);} else {throw new InputError('Bitte wählen Sie ein Datum, um sich die Kontaktpersonen anzeigen zu lassen.');}
        if ($tischnummer) {$sql->where('QrCode.tischnummer=?', $tischnummer);}
        if ($uhrzeit) {$sql->where(static::$tableName.'.uhrzeit=?', $uhrzeit);}

        $scans = $sql->execute();

        return $scans;
      }


      public static function getOldScan($qrcodeid, $benutzerid, $vergleichstag, $vergleichsuhrzeit) {

        $sql = new SelectQuery(static::$tableName);

        $sql->where('qrCodeId=?', $qrcodeid);
        $sql->where('benutzerId=?', $benutzerid);
        $sql->where('tag>=?', $vergleichstag);
        $sql->where('uhrzeit>=?', $vergleichsuhrzeit);

        $scans = $sql->execute();

        return $scans;
      }

    }
