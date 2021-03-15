<?php
#Intitutions Backend Übersicht Controller, erbt von Controller
  class InstitutionBackendUbersichtController extends Controller
  {
    //benutzt die Mixins: DrawTrenner, drawSvgGraphMixin, InstitutionLoginRequired
    use DrawTrennerMixin, drawSvgGraphMixin, InstitutionLoginRequiredMixin;

    //weißt das zu benutzende Template zu
    protected $template = 'institution/backendubersicht.php';

    //vearbeitet die get Nachfrage
    protected function get($request) {
        //erhalte die Instanz der angemeldetet Institution
        $object = InstitutionModel::getUserObject();
        //erhalte Datensätze der QR-Codes mit der angemeldeten Institutions ID
        $qrcodes = QrcodeModel::getQrcodes($object->id);

        //wenn eine Erfolgmeldung übergeben wurde, dann setze diese als Wert für succuess
        if(!empty($request["success"])) {
          $success = $request["success"];
        } else {
          $success = FALSE;
        }

        //Variablen die dem Template zur Verfügung stehen sollen
        $context = [
            "object" => $object,
            "qrcodes" => $qrcodes,
            "success" => $success,
        ];

        //stellt Template dar
        $this->render($context);
    }

    //vearbeitet die post Nachfrage
    protected function post($request) {
        $this->render();

    }

  }
