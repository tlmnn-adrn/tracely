<?php

  class InstitutionBackendQrcodedruckenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin, UserPassesTestMixin;

    protected $template = 'institution/backendqrcodedrucken.php';


    protected function get($request, $code='') {

        $qrcode = QrcodeModel::getQrcodeByCode($code)[0];

        $context = [
            "code" => $code,
            "qrcode" => $qrcode,
        ];

        $pdfAuthor = "tracely";
        $pdfName = "Qr-Code.pdf";
        $pdfTitle = "Qr-Code";

        #$this->render($context);

        $this->generatePdf(author: $pdfAuthor, fileName: $pdfName, title: $pdfTitle, context: $context);
    }

    protected function post($request) {

        $this->render();

    }

    protected function testFunc($code=''){

      $qrcode = QrcodeModel::getQrcodeByCode($code);
      $object = InstitutionModel::getUserObject();

      if(count($qrcode)==0){
        return FALSE;
      }

      return $qrcode[0]['institutionId'] == $object->id;

    }

  }
