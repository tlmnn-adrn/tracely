<?php

  class ScanErstellenController extends Controller
  {
    use DrawTrennerMixin, UserLoginRequiredMixin;

    protected $template = 'scan/erstellen.php';


    protected function get($request, $code='') {

      $object = UserModel::getUserObject();
      $code = QrcodeModel::getQrcodeByCode($code);
      if (count($code) == 0) {
        throw new NotFoundError('Der gescannte Qr-Code konnte nicht gefunden werden.');
      }

    #Quelle: https://www.php.net/manual/de/datetime.sub.php
      $aufenthaltszeit = $code[0]['aufenthaltszeit'];

      $date = new DateTime(date("Y-m-d H:i:s"));
      $date->sub(new DateInterval('PT'.$aufenthaltszeit.'M'));
      $vergleichstag = $date->format('Y-m-d');
      $vergleichsuhrzeit = $date->format('H:i:s');

      $oldscan = ScanModel::getOldScan($code[0][0], $object->id, $vergleichstag, $vergleichsuhrzeit);

      if (count($oldscan) == 0) {
        $scan = new ScanModel;

        $scan->qrCodeId = $code[0][0];
        $scan->benutzerId = $object->id;
        $scan->tag = date("Y-m-d");
        $scan->uhrzeit = date("H:i:s");

        $success = $scan->create();
      } else {
        $success = FALSE;
      }

      $context = [
          "object" => $object,
          "code" => $code,
          "success" => $success,
      ];

      $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
