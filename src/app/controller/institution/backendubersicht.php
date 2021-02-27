<?php

  class InstitutionBackendUbersichtController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendubersicht.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
