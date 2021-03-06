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
        $codes = $sql->execute();

        return $codes;
      }

    }
