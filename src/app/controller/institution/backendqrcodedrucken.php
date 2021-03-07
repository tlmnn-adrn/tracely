<?php

  class InstitutionBackendQrcodedruckenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodedrucken.php';


    protected function get($request, $code='') {
        $object = InstitutionModel::getUserObject();
        $qrcode = QrcodeModel::getQrcodeByCode($code);

        $context = [
            "qrcode" => $qrcode,
        ];

        $pdfAuthor = "tracely";
        $pdfName = "Qr-Code.pdf";
        $pdfTitle = "Qr-Code";

        #$this->render($context);

        $this->generatePdf(author: $pdfAuthor, fileName: $pdfName, title: $pdfTitle, context: $context);
    }

    protected function post($request) {
        $this->csrfToken();
        $this->render();
    }

    protected function testFunc($id=0) {

      $object = InstitutionModel::getUserObject();
      $code = ScanModel::getById($id);

      return $code->institutionId==$object->id;
    }

  }
