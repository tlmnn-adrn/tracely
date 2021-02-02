<?php

  class HomeController extends Controller
  {
    protected $template = 'home/home.php';

    protected function get($request, $arguments) {
      $this->render();
    }
    protected function post($request, $arguments) {
      $this->render();
    }


  }
