<?php

  class InstitutionBackendQrcodelöschenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodelöschen.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();

        $context = [
            "object" => $object,
            "success"=> FALSE,
        ];

        $this->render($context);
    }

    protected function post($request) {

      $code = QrcodeModel::getQrcode($request["qrcodelöschen"]);

      $context = [
        "code" => $code,
      ];

      $this->render($context);

    }

  }
