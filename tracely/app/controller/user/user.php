<?php
require_once '../core/base/controller/controller.php';
require_once '../core/404.php';

  class UserController extends Controller
  {
    protected $template = 'user/user.php';



    protected function get($request, $arguments) {

      $id = $arguments["id"];
      $object = UserModel::getById($id);

      $context = [
        "object" => $object,
      ];
      $this->render($context);
    }
    protected function post($request, $arguments) {

    }

    function __construct($arguments=[]) {
      $this->includeModel("user");
      parent::__construct($arguments);

    }


  }
