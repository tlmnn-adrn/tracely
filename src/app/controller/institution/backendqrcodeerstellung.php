<?php

  class InstitutionBackendQrcodeerstellungController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodeerstellung.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $code = new QrcodeModel;

        $context = [
            "object" => $object,
            "code" => $code,
            "success"=> FALSE
        ];

        $this->render($context);
    }

    protected function post($request) {

      $object = InstitutionModel::getUserObject();
      $code = new QrcodeModel;

      $code->tischnummer = $request["tischnummer"];
      $code->sitzplätze = $request["sitzplätze"];
      $code->code = "123";
      $code->institutionId = $object->id;

      $success = $code->create();

      $context = [
          "object" => $object,
          "code" => $code,
          "success" => $success,
      ];

      $this->csrfToken();
      $this->render($context);

    }

  }
