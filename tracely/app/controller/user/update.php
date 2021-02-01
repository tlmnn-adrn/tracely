<?php
require_once '../core/base/controller/controller.php';
require_once '../core/404.php';

  class UserUpdateController extends Controller
  {
    protected $template = 'user/update.php';



    protected function get($request, $arguments) {
      $id = $arguments["id"];
      $object = UserModel::getById($id);

      $context = [
        "object" => $object,
      ];
      $this->render($context);
    }

    protected function post($request, $arguments) {
      $id = $arguments["id"];
      $object = UserModel::getById($id);

      $object->setField("vorname", $request["vorname"]);
      $object->setField("nachname", $request["nachname"]);

      if ($request["passwortalt"] == ) {
        // code...
      }

      $object->setField("nachname", $request["nachname"]);

      $object->update();

      $context = [
        "object" => $object,
      ];
      $this->render($context);
    }

    function __construct($arguments=[]) {
      $this->includeModel("user");
      parent::__construct($arguments);

    }


  }
