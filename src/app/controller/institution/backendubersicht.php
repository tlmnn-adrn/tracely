<?php

  class InstitutionBackendUbersichtController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendubersicht.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $qrcodes = QrcodeModel::getQrcodes($object->id);

        if(!empty($request["success"])) {
          $success = $request["success"];
        } else {
          $success = FALSE;
        }

        for ($i=6; $i >= 0; $i--) {
          $date = new DateTime(date("Y-m-d"));
          $date->sub(new DateInterval('P'.$i.'D'));
          $tag = $date->format('Y-m-d');

          $scan = ScanModel::getScans($object->id, $tag, FALSE, FALSE);

          $scans[] = count($scan);
        }



        $context = [
            "object" => $object,
            "qrcodes" => $qrcodes,
            "scans" => $scans,
            "success" => $success,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
