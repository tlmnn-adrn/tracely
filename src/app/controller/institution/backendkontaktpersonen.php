<?php

  class InstitutionBackendKontaktpersonenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendkontaktpersonen.php';


    protected function get($request) {
      $object = InstitutionModel::getUserObject();
      
      $tag = isset($request["tag"])?$request["tag"]:FALSE;
      $tischnummer = isset($request["tischnummer"])?$request["tischnummer"]:FALSE;
      $uhrzeit = isset($request["uhrzeit"])?$request["uhrzeit"]:FALSE;

      $scans = ScanModel::getScans(id: $object->id, tag: $tag, tischnummer: $tischnummer, uhrzeit: $uhrzeit);

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
