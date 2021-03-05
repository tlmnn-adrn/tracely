<?php

  class InstitutionBackendUbersichtController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendubersicht.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $qrcodes = QrcodeModel::getQrcodes($object->id);

        if(!empty($request["success"])) {
          $success = $request["success"];
        } else {
          $success = FALSE;
        }

        $context = [
            "object" => $object,
            "qrcodes" => $qrcodes,
            "success" => $success,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
