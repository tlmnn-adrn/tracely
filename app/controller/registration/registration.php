<?php

  class UserRegistrationController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'registration/registration.php';


    protected function get($request, $id=0) {

      $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = new UserModel;

      $this->render($context);
    }

  }
