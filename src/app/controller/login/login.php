<?php
#Loginauswahl Controller
  class LoginController extends Controller
  {
    use DrawTrennerMixin;

    protected $template = 'login/login.php';


    protected function get($request) {

        $this->render();
    }

    protected function post($request) {

        $this->render();

    }

  }
