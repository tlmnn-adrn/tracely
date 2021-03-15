<?php
#Institutionseinstellungen Controller
  class InstitutionBackendEinstellungenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'institution/backendeinstellungen.php';


    protected function get($request) {

        $object = InstitutionModel::getUserObject();

        $context = [
            "object" => $object,
            "success" => FALSE,
        ];

        $this->render($context);
    }

    protected function post($request) {
      $object = InstitutionModel::getUserObject();
      //weiße den Attributen der Instanz die übergebenen Werte zu
      $object->name = $request["name"];
      $object->adresse = $request["adresse"];
      $object->plz = $request["plz"];
      $object->stadt = $request["stadt"];
      $object->email = $request["email"];
      $object->institutionsartId = $request["institutionsartId"];

      if ($request["passwort"] && $request["passwortWiederholen"] && $request["passwortAlt"]) {
        $object->setPassword(field: "passwort", value: $request["passwort"], repeatValue: $request["passwortWiederholen"], oldValue: $request["passwortAlt"]);
      }

      //aktualisiert die Datenfelder des Datensatzes
      $success = $object->update();

      $context = [
          "object" => $object,
          "success" => $success,
      ];

      $this->render($context);

    }

  }
