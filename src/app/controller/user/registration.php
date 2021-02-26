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

      $object->vorname = $request["vorname"];
      $object->nachname = $request["nachname"];
      $object->email = $request["email"];
      $object->telefonnummer = $request["telefonnummer"];
      $object->plz = $request["plz"];
      $object->setPassword("passwort", $request["passwort"], $request["passwortWiederholen"], $request["passwortAlt"]);

      $success = $object->create();

      if($success){
        UserModel::login($request['email'], $request['passwort']);
      }

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

  }
