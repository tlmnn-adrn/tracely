<?php
#Controller für die Darstellung des SVG Graphen
    class GetHistorySvgController extends Controller
    {

        use drawSvgGraphMixin;

        protected $template = 'home/home.php';

        protected function get($request, $time=7) {

            $object = InstitutionModel::getUserObject();

            //zählt die Anzahl der Scans pro Tag im übergebenen Zeitraum time
            for ($i=($time-1); $i >= 0; $i--) {
              #Quelle: https://www.php.net/manual/de/datetime.sub.php
                //ermittle das heutige Datum
                $date = new DateTime(date("Y-m-d"));
                //subtrahiere das heutige Datum um i Tage
                $date->sub(new DateInterval('P'.$i.'D'));
                //übergebe dieses Datum im Format Y-m-d
                $tag = $date->format('Y-m-d');

                //erhalte die Datensätze an diesem Datum
                $scan = ScanModel::getScans($object->id, $tag, FALSE, FALSE);

                //zähle die Datensätze und erweitere den array scans
                $scans[] = count($scan);
              }

            //Deklariert den Inhaltstypen
            header("Content-type: image/svg+xml");
            //übermittelt den array der entsprechenden Methode
            $this->drawSvgGraph($scans, 940, 320);


        }

        protected function post($request) {

        }

    }
