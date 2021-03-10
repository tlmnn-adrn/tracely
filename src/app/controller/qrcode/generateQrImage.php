<?php

  class GenerateQrImage extends Controller
  {

    protected function get($request, $code='') {

        $qr = QRCode::getMinimumQRCode(Url::find('scan-erstellen', $code), QR_ERROR_CORRECT_LEVEL_L);

        $im = $qr->createImage(8, 4);
        
        header("Content-type: image/png");
        imagepng($im);
        
        imagedestroy($im);

        #QRcode::png(Url::find('scan-erstellen', $code));

    }

    protected function post($request, $code='') {

    }

  }
