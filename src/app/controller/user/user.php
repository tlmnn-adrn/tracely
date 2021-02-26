<?php

  class UserController extends Controller
  {

    use DrawTrennerMixin;
    protected $template = 'user/user.php';

    protected function get($request, $id=0) {

      $object = UserModel::getById($id);
      
      $context = [
        "object" => $object,
      ];

      $this->render($context);

    }

    protected function post($request, $id=0) {

    }

  }
