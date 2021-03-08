<?php

  class InstitutionBackendQrcodedruckenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodedrucken.php';


    protected function get($request, $code='') {

        $qrcode = QrcodeModel::getQrcodeByCode($code);

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

  }
