<?php

    class QrcodeModel extends AuthModel{

      static $tableName = "QrCode";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'code' => new TextField(required: TRUE),
          'tischnummer' => new IntegerField(required: TRUE, unique:TRUE),
          'sitzplätze' => new IntegerField(required: TRUE),
          'institutionId' => new ForeignKeyField(model:'InstitutionsartModel', required:TRUE),
        ];

        parent::__construct($values);

      }

      public static function getQrcodes($institutionId) {

        $sql = new SelectQuery(static::$tableName, get_called_class());
        $sql->where('institutionId=?', $institutionId);
        $sql->order('tischnummer');
        $qrcodes = $sql->execute();

        return $qrcodes;
      }

      public static function getQrcodeByCode($code) {

        $sql = new SelectQuery(static::$tableName);
        $sql->join('Institution', static::$tableName.'.institutionId = Institution.id');
        $sql->join('Institutionsart', 'Institution.institutionsartId = Institutionsart.id');

        $sql->where('code=?', $code);
        $qrcode = $sql->execute();

        return $qrcode;
      }

    }
