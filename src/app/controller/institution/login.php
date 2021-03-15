<?php
#Institutionslogin Controller
  class InstitutionLoginController extends Controller
  {
    use DrawTrennerMixin;

    protected $template = 'institution/login.php';


    protected function get($request) {
        //erzeuge eine neue Instanz
        $object = new InstitutionModel();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
        //führe die Login Funktion aus
        InstitutionModel::login($request["email"], $request["passwort"]);

        //erzeuge neue Instanz und weiße dem Objekt die E-Mail zu
        $object = new InstitutionModel();
        $object->email = $request["email"];

        $context = [
            "object" => $object,
        ];

        $this->render($context);

    }

  }
