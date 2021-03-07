<?php

  class InstitutionBackendEinstellungenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendeinstellungen.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();

        $context = [
            "object" => $object,
            "success" => FALSE,
        ];

        $this->render($context);
    }

    protected function post($request) {
      $object = InstitutionModel::getUserObject();

      $object->name = $request["name"];
      $object->adresse = $request["adresse"];
      $object->plz = $request["plz"];
      $object->stadt = $request["stadt"];
      $object->email = $request["email"];
      //Art fehlt

      if ($request["passwort"] && $request["passwortWiederholen"] && $request["passwortAlt"]) {
        $object->setPassword(field: "passwort", value: $request["passwort"], repeatValue: $request["passwortWiederholen"], oldValue: $request["passwortAlt"]);
      }

      $success = $object->update();

      $context = [
          "object" => $object,
          "success" => $success,
      ];
      
      $this->csrfToken();
      $this->render($context);

    }

  }
