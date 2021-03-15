<?php
#Backend Controller
  class BackendController extends Controller
  {

    use DrawTrennerMixin, LoginRequiredMixin, LoginRedirectMixin;

    protected $template = 'backend/backend.php';

    protected function get($request) {
      $this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
