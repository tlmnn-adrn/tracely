<?php
#Scan erstellen Controller
  class ScanErstellenController extends Controller
  {
    use DrawTrennerMixin, UserLoginRequiredMixin;

    protected $template = 'scan/erstellen.php';


    protected function get($request, $code='') {

      $object = UserModel::getUserObject();
      $code = QrcodeModel::getQrcodeByCode($code);
      //überprüft, ob ein übergebener Code vorhanden ist
      if (count($code) == 0) {
        throw new NotFoundError('Der gescannte Qr-Code konnte nicht gefunden werden.');
      }

      $aufenthaltszeit = $code[0]['aufenthaltszeit'];

      //ermittelt, ob der gescannte QR-Code durch die Privatperson im Aufenthaltszeitraum ein zweites mal gescannt wurde
    #Quelle: https://www.php.net/manual/de/datetime.sub.php
      $date = new DateTime(date("Y-m-d H:i:s"));
      $date->sub(new DateInterval('PT'.$aufenthaltszeit.'M'));
      $vergleichstag = $date->format('Y-m-d');
      $vergleichsuhrzeit = $date->format('H:i:s');

      $oldscan = ScanModel::getOldScan($code[0][0], $object->id, $vergleichstag, $vergleichsuhrzeit);

      //falls kein Scan im Aufenthaltszeitraum dann erzeuge einen neuen Datensatz
      if (count($oldscan) == 0) {
        $scan = new ScanModel;

        $scan->qrCodeId = $code[0][0];
        $scan->benutzerId = $object->id;
        $scan->tag = date("Y-m-d");
        $scan->uhrzeit = date("H:i:s");

        $success = $scan->create();
      } else {
      //falls Scan, dann FALSE
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
