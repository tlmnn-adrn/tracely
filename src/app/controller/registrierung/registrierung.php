<?php
#Registrierungsauswahl Controller
  class RegistrierungController extends Controller
  {
    use DrawTrennerMixin;

    protected $template = 'registrierung/registrierung.php';


    protected function get($request) {

        $this->render();
    }

    protected function post($request) {

        $this->render();

    }

  }
