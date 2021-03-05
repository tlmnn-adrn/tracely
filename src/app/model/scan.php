<?php

    class ScanModel extends AuthModel{

      static $tableName = "Scan";
      protected $fields = [];

      public function __construct($values=[]) {
        $this->fields = [
          'qrCodeId' => new ForeignKeyField(model:'QrCodeModel', required:TRUE),
          'benutzerId' => new ForeignKeyField(model:'UserModel', required:TRUE),
          'zeitpunkt' => new DateField(required: TRUE),
        ];

        parent::__construct($values);

      }

    }
