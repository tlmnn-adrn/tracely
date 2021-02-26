<?php

  class UserBackendUbersichtController extends Controller
  {
    use DrawTrennerMixin, UserLoginRequiredMixin;

    protected $template = 'user/backendubersicht.php';


    protected function get($request) {

        $object = UserModel::getUserObject();
        $object->vorname = "Jakob";
        $object->update();

        $context = [
            "object" => $object,
        ];

        $this->render($context);
    }

    protected function post($request) {
        $this->render();

    }

  }
