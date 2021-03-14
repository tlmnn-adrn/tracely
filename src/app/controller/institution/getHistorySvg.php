<?php

    class GetHistorySvgController extends Controller
    {

        use drawSvgGraphMixin;

        protected $template = 'home/home.php';

        protected function get($request, $time=7) {

            $object = InstitutionModel::getUserObject();

            for ($i=($time-1); $i >= 0; $i--) {
                $date = new DateTime(date("Y-m-d"));
                $date->sub(new DateInterval('P'.$i.'D'));
                $tag = $date->format('Y-m-d');

                $scan = ScanModel::getScans($object->id, $tag, FALSE, FALSE);

                $scans[] = count($scan);
              }

            header("Content-type: image/svg+xml");
            $this->drawSvgGraph($scans, 940, 320);


        }

        protected function post($request) {

        }

    }
