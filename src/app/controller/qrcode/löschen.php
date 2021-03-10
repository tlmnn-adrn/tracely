<?php

  class QrcodelöschenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin, UserPassesTestMixin;

    protected $template = 'qrcode/löschen.php';


    protected function get($request, $id=0) {

        $object = InstitutionModel::getUserObject();
        $code = QrcodeModel::getById($id);

        $context = [
            "object" => $object,
            "code" => $code,
            "success"=> FALSE,
        ];

        $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = InstitutionModel::getUserObject();
      $code = QrcodeModel::getById($id);

      ScanModel::deleteByCodeId($id);
      $code->delete();

      header('Location: '.Url::find('backend-institution').'?success=QR-Code wurde erfolgreich gelöscht');
      exit;

    }

    protected function testFunc($id=0) {

      $object = InstitutionModel::getUserObject();
      $code = QrcodeModel::getById($id);

      return $code->institutionId==$object->id;
    }

  }
