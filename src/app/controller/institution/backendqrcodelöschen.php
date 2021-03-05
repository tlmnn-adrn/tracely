<?php

  class InstitutionBackendQrcodelöschenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodelöschen.php';


    protected function get($request, $id=0) {

        $object = InstitutionModel::getUserObject();
        $code = QrcodeModel::getQrcode($id);

        $context = [
            "object" => $object,
            "code" => $code,
            "success"=> FALSE,
        ];

        $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = InstitutionModel::getUserObject();
      $code = QrcodeModel::getQrcode($id);

      $context = [
        "object" => $object,
        "code" => $code,
        "success" => TRUE,
      ];

      $this->render($context);

    }

  }
