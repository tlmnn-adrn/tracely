<?php

  class InstitutionRegistrationController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'institution/registration.php';


    protected function get($request, $id=0) {

      $object = new InstitutionModel;

      $context = [
          "object" => $object,
      ];

      $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = new InstitutionModel;

      $object->setField("name", $request["name"]);
      $object->setField("adresse", $request["adresse"]);
      $object->setField("plz", $request["plz"]);
      $object->setField("stadt", $request["stadt"]);
      $object->setField("email", $request["email"]);
      $object->setField("institutionsartId", $request["institutionsartId"]);
      $object->setField("passwort", $request["passwort"], $request["passwortWiederholen"]);

      $success = $object->create();

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

  }
