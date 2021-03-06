<?php

  class InstitutionBackendKontaktpersonenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendkontaktpersonen.php';


    protected function get($request) {
      $object = InstitutionModel::getUserObject();
      $zeitpunkt = $request["zeitpunkt"];

      $scans = ScanModel::getScansOnDay($zeitpunkt);

        $context = [
            "object" => $object,
            "scans" => $scans,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $context = [

        ];
        $this->render();

    }

    protected function testFunc($id=0) {

      $object = InstitutionModel::getUserObject();
      $code = ScanModel::getById($id);

      return $code->institutionId==$object->id;
    }

  }
