<?php
#Scan löschen Controller
class ScanController extends Controller
{
  use DrawTrennerMixin, UserLoginRequiredMixin;

  protected $template = 'scan/scan.php';

  protected function get($request, $code='') {

    $this->render();

  }

  protected function post($request) {

      $this->render();

  }

}
