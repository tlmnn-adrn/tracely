<?php
#Privatpersoneneinstellungen Controller
  //äquivalent zu Institutionseinstellungen
  class UserBackendEinstellungenController extends Controller
  {
    use DrawTrennerMixin, UserLoginRequiredMixin;

    protected $template = 'user/backendeinstellungen.php';


    protected function get($request) {

        $object = UserModel::getUserObject();

        $context = [
            "object" => $object,
            "success" => FALSE,
          ];

        $this->render($context);
    }

    protected function post($request) {
      $object = UserModel::getUserObject();

      $object->vorname = $request["vorname"];
      $object->nachname = $request["nachname"];
      $object->email = $request["email"];
      $object->telefonnummer = $request["telefonnummer"];
      $object->plz = $request["plz"];

      if ($request["passwort"] && $request["passwortWiederholen"] && $request["passwortAlt"]) {
        $object->setPassword(field: "passwort", value: $request["passwort"], repeatValue: $request["passwortWiederholen"], oldValue: $request["passwortAlt"]);
      }

      $success = $object->update();

      $context = [
          "object" => $object,
          "success" => $success,
      ];

      $this->render($context);

    }

  }
