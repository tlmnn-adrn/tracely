<?php

  class ImpressumController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'impressum/impressum.php';

    protected function get($request) {
      $this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
