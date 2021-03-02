<?php

    class QrcodeModel extends AuthModel{

      static $tableName = "qrcode";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'code' => new TextField(required: TRUE),
          'tischnummer' => new TextField(required: TRUE),
          'sitzplaetze' => new TextField(required: TRUE),
          'institutionId' => new TextField(required: TRUE),
        ];

        parent::__construct($values);

      }

      public static function getAllQrcodes($institutionId) {

        $sql = new SelectQuery(static::$tableName, get_called_class());
        $sql->where('institutionId=?', $institutionId);
        $codes = $sql->execute();

        return $codes;
      }

    }
