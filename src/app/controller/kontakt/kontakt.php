<?php
#Kontaktseiten Controller
  class KontaktController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'kontakt/kontakt.php';

    protected function get($request) {
      $this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
