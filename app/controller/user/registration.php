<?php

  class UserRegistrationController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'user/registration.php';


    protected function get($request, $id=0) {

      $object = new UserModel;

      $context = [
          "object" => $object,
      ];

      $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = new UserModel;

      $object->setField("vorname", $request["vorname"]);
      $object->setField("nachname", $request["nachname"]);
      $object->setField("email", $request["email"]);
      $object->setField("telefonnummer", $request["telefonnummer"]);
      $object->setField("plz", $request["plz"]);
      $object->setField("passwort", $request["passwort"], $request["passwortWiederholen"], $request["passwortAlt"]);

      $success = $object->create();

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

  }
