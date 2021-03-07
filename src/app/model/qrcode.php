<?php

    class QrcodeModel extends AuthModel{

      static $tableName = "QrCode";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'code' => new TextField(required: TRUE),
          'tischnummer' => new IntegerField(required: TRUE),
          'sitzplätze' => new IntegerField(required: TRUE),
          'institutionId' => new ForeignKeyField(model:'InstitutionsartModel', required:TRUE),
        ];

        parent::__construct($values);

      }

      public static function getQrcodes($institutionId) {

        $sql = new SelectQuery(static::$tableName, get_called_class());
        $sql->where('institutionId=?', $institutionId);
        $qrcodes = $sql->execute();

        return $qrcodes;
      }

      public static function getQrcodeByCode($code) {

        $sql = new SelectQuery(static::$tableName);
        $sql->join('institution', static::$tableName.'.institutionId = institution.id');
        $sql->join('institutionsart', 'institution.institutionsartId = institutionsart.id');

        $sql->where('code=?', $code);
        $qrcode = $sql->execute();

        return $qrcode;
      }

    }
