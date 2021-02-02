<?php

  class UserUpdateController extends Controller
  {

    protected $template = 'user/update.php';


    protected function get($request, $id=0) {
      $object = UserModel::getById($id);

      $context = [
        "object" => $object,
      ];
      $this->render($context);
    }

    protected function post($request, $id=0) {
      $object = UserModel::getById($id);

      $object->setField("vorname", $request["vorname"]);
      $object->setField("nachname", $request["nachname"]);
      $object->setField("plz", $request["plz"]);
      $object->setField("email", $request["email"]);
      $object->setField("passwort", $request["passwort"], $request["passwortWiederholen"], $request["passwortAlt"]);

      $object->update();

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

    function __construct($arguments) {
      $this->includeModel("user");
      parent::__construct($arguments);

    }


  }
