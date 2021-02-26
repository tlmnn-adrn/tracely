<?php

  class InstitutionLoginController extends Controller
  {
    use DrawTrennerMixin;

    protected $template = 'institution/login.php';


    protected function get($request) {

        $object = new InstitutionModel();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {

        InstitutionModel::login($request["email"], $request["passwort"]);

        $object = new InstitutionModel();
        $object->email = $request["email"];

        $context = [
            "object" => $object,
        ];

        $this->render($context);

    }

  }
