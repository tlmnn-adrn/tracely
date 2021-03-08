<?php

  class InstitutionBackendKontaktpersonenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendkontaktpersonen.php';


    protected function get($request) {
      $object = InstitutionModel::getUserObject();
      $parameter = '';

      $tag = isset($request["tag"])?$request["tag"]:FALSE;
      $tischnummer = isset($request["tischnummer"])?$request["tischnummer"]:FALSE;
      $uhrzeit = isset($request["uhrzeit"])?$request["uhrzeit"]:FALSE;

      $scans = ScanModel::getScans(id: $object->id, tag: $tag, tischnummer: $tischnummer, uhrzeit: $uhrzeit);

      $parameter = $this->InfoParameter($tag, 'Datum', $parameter);
      $parameter = $this->InfoParameter($tischnummer, 'Tischnummer', $parameter);
      $parameter = $this->InfoParameter($uhrzeit, 'Uhrzeit', $parameter);

        $context = [
            "object" => $object,
            "scans" => $scans,
            "parameter" => $parameter,
        ];

        $pdfAuthor = "tracely";
        $pdfName = date('Ymd')."_Kontaktpersonen_".$object->name.".pdf";
        $pdfTitle = "Kontaktpersonen";

        #$this->render($context);

        $this->generatePdf(author: $pdfAuthor, fileName: $pdfName, title: $pdfTitle, context: $context);
    }

    protected function post($request) {

        $this->render();
    }

    protected function testFunc($id=0) {

      $object = InstitutionModel::getUserObject();
      $code = ScanModel::getById($id);

      return $code->institutionId==$object->id;
    }

    private function InfoParameter($para, $beschreibung, $parameter) {
      if ($para) {
        $parameter .= '<p><b>'.$beschreibung.':</b> '.$para.'</p>';
      }
      return $parameter;
    }

  }
