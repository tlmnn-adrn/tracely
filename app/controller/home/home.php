<?php

  class HomeController extends Controller
  {
    protected $template = 'home/home.php';

    protected function get($request) {
      $this->render();
    }
    protected function post($request) {
      $this->render();
    }


  }