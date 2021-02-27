<?php

  class BackendController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'backend/backend.php';

    protected function get($request) {
      $this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
