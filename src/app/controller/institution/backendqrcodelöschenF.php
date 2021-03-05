<?php

  class InstitutionBackendQrcodelöschenFController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendqrcodelöschen.php';


    protected function get($request) {
        $this->render();
    }

    protected function post($request) {

      $code = QrcodeModel::getQrcode($request['qrcodelöschenF']);

      echo "QR-Code gelöscht. Naja noch nicht ganz...";

      header('Location: '.Url::find('backend-institution').'?success=QR-Code erfolgreich gelöscht.');

      $this->render();

    }

  }
