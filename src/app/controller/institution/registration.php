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

      $object->name = $request["name"];
      $object->adresse = $request["adresse"];
      $object->plz = $request["plz"];
      $object->stadt = $request["stadt"];
      $object->email = $request["email"];
      $object->institutionsartId = $request["institutionsartId"];
      $object->setPassword('passwort', $request["passwort"], $request["passwortWiederholen"]);

      $success = $object->create();

      if($success){
        InstitutionModel::login($request['email'], $request['passwort']);
      }

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

  }
