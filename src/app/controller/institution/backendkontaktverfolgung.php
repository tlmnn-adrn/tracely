<?php

  class InstitutionBackendKontaktverfolgungController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendkontaktverfolgung.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $code = new QrcodeModel;
        $scan = new ScanModel;

        $context = [
            "object" => $object,
            "code" => $code,
            "scan" => $scan,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
