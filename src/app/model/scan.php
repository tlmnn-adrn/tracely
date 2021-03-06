<?php

    class ScanModel extends AuthModel{

      static $tableName = "scan";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'qrCodeId' => new ForeignKeyField(model:'QrCodeModel', required:TRUE),
          'benutzerId' => new ForeignKeyField(model:'UserModel', required:TRUE),
          'tag' => new DateField(required: TRUE),
          'uhrzeit' => new DateField(required: TRUE),
        ];

        parent::__construct($values);

      }

      public static function getScans($id, $tag, $tischnummer, $uhrzeit) {

        $sql = new SelectQuery(static::$tableName);
        $sql->join('benutzer', static::$tableName.'.benutzerId = benutzer.id');
        $sql->join('qrcode', static::$tableName.'.qrcodeId = qrcode.id');

        $sql->where('qrcode.institutionId=?', $id);

        if ($tag) {$sql->where(static::$tableName.'.tag=?', $tag);} else {throw new InputError('Bitte wählen Sie ein Datum, um sich die Kontaktpersonen anzeigen zu lassen.');}
        if ($tischnummer) {$sql->where('qrcode.tischnummer=?', $tischnummer);}
        if ($uhrzeit) {$sql->where(static::$tableName.'.uhrzeit=?', $uhrzeit);}

        $scans = $sql->execute();

        return $scans;
      }

    }
