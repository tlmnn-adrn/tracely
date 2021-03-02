<?php

  class InstitutionBackendQrcodeerstellungController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodeerstellung.php';


    protected function get($request) {

        $object = QrcodeModel::getUserObject();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
      $newobject = new QrcodeModel;

      //$object->code = $request[""];
      $newobject->tischnummer = $request["name"];
      $newobject->sitzplaetze = $request["adresse"];
      $newobject->institutionId = $_SESSION["userId"];

      $success = $newobject->create();

      $context = [
          "object" => $object,
          "success" => $success,
      ];

      $this->render($context);

    }

  }
