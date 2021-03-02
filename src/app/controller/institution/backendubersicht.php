<?php

  class InstitutionBackendUbersichtController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendubersicht.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $qrcodes = QrcodeModel::getQrcodes($object->id);

        $context = [
            "object" => $object,
            "qrcodes" => $qrcodes,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
