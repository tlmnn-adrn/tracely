<?php

  class HomeController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'home/home.php';

    protected function get($request) {

      $context = [];
      $this->render($context);
    }
    protected function post($request) {
      $this->render();
    }

  }
