<?php

  class LogoutController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'backend/backend.php';

    protected function get($request) {
      AuthModel::logout();
      //$this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
