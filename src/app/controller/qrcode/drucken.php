<?php

  class QrcodedruckenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin, UserPassesTestMixin;

    protected $template = 'qrcode/drucken.php';


    protected function get($request, $code='') {

        $qrcode = QrcodeModel::getQrcodeByCode($code)[0];

        $context = [
            "code" => $code,
            "qrcode" => $qrcode,
        ];

        $pdfAuthor = "tracely";
        $pdfName = "TNr-".$qrcode['tischnummer']."_QrCode.pdf";
        $pdfTitle = "Qr-Code";

        $this->generatePdf(author: $pdfAuthor, fileName: $pdfName, title: $pdfTitle, context: $context);
    }

    protected function post($request) {

        $this->render();

    }

    protected function testFunc($code=''){

      $qrcode = QrcodeModel::getQrcodeByCode($code);
      $object = InstitutionModel::getUserObject();

      echo $qrcode[0]['institutionId']." ".$object->id;

      if(count($qrcode)==0){
        return FALSE;
      }

      return $qrcode[0]['institutionId'] == $object->id;

    }

  }
