<?php

  class UserLoginController extends Controller
  {

    protected $template = 'user/login.php';


    protected function get($request) {
    
        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
        
        UserModel::login($request["email"], $request["passwort"]);

        $object = new UserModel(["email"=>$request["email"]]);
        
        $context = [
            "object" => $object,
        ];

        $this->render($context);

    }

  }