<?php
#Institutions Registrierungs Controller
  class InstitutionRegistrierungController extends Controller
  {

    use DrawTrennerMixin;

    protected $template = 'institution/registrierung.php';


    protected function get($request, $id=0) {

      $object = new InstitutionModel;

      $context = [
          "object" => $object,
      ];

      $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = new InstitutionModel;

      //weißt die übergebenen Werte den Attributen des Objektes zu
      $object->name = $request["name"];
      $object->adresse = $request["adresse"];
      $object->plz = $request["plz"];
      $object->stadt = $request["stadt"];
      $object->email = $request["email"];
      $object->institutionsartId = $request["institutionsartId"];
      $object->setPassword('passwort', $request["passwort"], $request["passwortWiederholen"]);

      //erstelle einen neuen Datensatz in der Tabelle der Institution
      $success = $object->create();

      //bei erfolgreicher Erstellung wird die Insitution angemeldet
      if($success){
        InstitutionModel::login($request['email'], $request['passwort']);
      }

      $context = [
        "object" => $object,
      ];

      $this->render($context);
    }

  }
