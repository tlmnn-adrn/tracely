<?php
#Kontaktpersonenausgabe Controller
  class InstitutionBackendKontaktpersonenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendkontaktpersonen.php';


    protected function get($request) {
      $object = InstitutionModel::getUserObject();
      $parameter = '';

      //Überprüft welche Parameter übergeben wurden, wenn nicht dann FALSE
      $tag = isset($request["tag"])?$request["tag"]:FALSE;
      $tischnummer = isset($request["tischnummer"])?$request["tischnummer"]:FALSE;
      $uhrzeit = isset($request["uhrzeit"])?$request["uhrzeit"]:FALSE;

      //erhalte die Scans mit den übergebenen Parametern
      //Parameterübergabe erfolgt hierbei mit named Arguments
      $scans = ScanModel::getScans(id: $object->id, tag: $tag, tischnummer: $tischnummer, uhrzeit: $uhrzeit);

      //Formuliert die verwendeten Parameter in eine Ausgabe
      $parameter = $this->InfoParameter($tag, 'Datum', $parameter);
      $parameter = $this->InfoParameter($tischnummer, 'Tischnummer', $parameter);
      $parameter = $this->InfoParameter($uhrzeit, 'Uhrzeit', $parameter);

        $context = [
            "object" => $object,
            "scans" => $scans,
            "parameter" => $parameter,
        ];

        //setzt Informationen zur PDF-Datei
        $pdfAuthor = "tracely";
        $pdfName = date('Ymd')."_Kontaktpersonen_".$object->name.".pdf";
        $pdfTitle = "Kontaktpersonen";

        #$this->render($context);

        //erzeugt eine PDF-Datei
        $this->generatePdf(author: $pdfAuthor, fileName: $pdfName, title: $pdfTitle, context: $context);
    }

    protected function post($request) {

        $this->render();
    }

    //überprüft, ob ein aufgerufener Scan der Insitution zugeordnet ist
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
