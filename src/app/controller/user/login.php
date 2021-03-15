<?php
#Privatpersonenlogin Controller
  //äquivalent zu Institutionslogin
  class UserLoginController extends Controller
  {

    use DrawTrennerMixin, LoginRedirectMixin;

    protected $template = 'user/login.php';


    protected function get($request) {

        $object = new UserModel();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {

        UserModel::login($request["email"], $request["passwort"]);

        $object = new UserModel();
        $object->email = $request["email"];

        $context = [
            "object" => $object,
        ];

        $this->render($context);

    }

  }
