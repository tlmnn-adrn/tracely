<?php

    class TestController extends Controller
    {

        use DrawTrennerMixin;

        protected $template = 'home/home.php';

        protected function get($request) {
            echo('<script src="'.Url::find('static', 'js/qr/scan.js').'"></script>');
            echo('<video id="videoOutput"></video>');

        }

        protected function post($request) {

            $object = new ScanModel;

            $object->qrCodeId = $request['qrCodeId'];
            $object->benutzerId = $request['benutzerId'];
            $object->zeitpunkt = date('Y-m-d H:i:s');

            $object->create();
        }

    }
