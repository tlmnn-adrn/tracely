<?php

  class RegistrationController extends Controller
  {
    use DrawTrennerMixin;

    protected $template = 'registration/registration.php';


    protected function get($request) {

        $this->render();
    }

    protected function post($request) {

        $this->render();

    }

  }
