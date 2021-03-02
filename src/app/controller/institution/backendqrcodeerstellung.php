<?php

  class InstitutionBackendQrcodeerstellungController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodeerstellung.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
      $object = new QrcodeModel;

      //$object->code = $request[""];
      $object->tischnummer = $request["name"];
      $object->sitzplätze = $request["adresse"];
      $object->institutionId = $_SESSION["userId"];

      $success = $object->create();

      $context = [
          "object" => $object,
          "success" => $success,
      ];

      $this->render($context);

    }

  }
