<?php

    trait drawSvgGraphMixin{

        function drawSvgGraph($array, $width, $height) {
          $max = max(1, max($array));

          for ($i=0; $i < count($array); $i++) {
            $y[$i] = ($height - 1) - (($array[$i] / $max) * ($height-40));
          }
          for ($n=0; $n < count($array); $n++) {
            $x[$n] = $n * ($width / (count($array)-1)) + 10;
          }

          $points = '';
          for ($k=0; $k < count($x); $k++) {
            $points .= $x[$k].','.$y[$k].' ';
          }

          $widthframe = $width + 100;
          $heightframe = $height + 40;

          echo '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'px" height="'.$height.'px" viewBox="-50 0 '.$widthframe.' '.$heightframe.'">

            <defs>
              <linearGradient id="grad" gradientTransform="rotate(90)">
                  <stop offset="0%" stop-color="#ffcccd"/>
                  <stop offset="100%" stop-color="white"/>
              </linearGradient>
              </defs>

            <polygon fill="#c6d9fd" points="
              '.$x[0].','.$height.' '.$points.' '.$x[count($x)-1].','.$height.'
            "></polygon>
            <polyline fill="none" stroke="#FF4749" stroke-width="2" points="
              '.$points.'
            "></polyline>

          ';

          if ((count($x)-1) < 29) {
            for ($o=0; $o < count($y); $o++) {
              $ytext = $y[$o] - 10;
              echo '
              <text x="'.$x[$o].'" y="'.$ytext.'" font-size="22">'.$array[$o].'</text>
              <circle cx="'.$x[$o].'" cy="'.$y[$o].'" r="4" fill="#FF4749"></circle>
              ';
            }
          } else {
            $xmax0 = array_keys($y, min($y));
            $xmax = $x[$xmax0[0]];
            $ymaxtext = min($y) - 10;
              echo '
              <text x="'.$xmax.'" y="'.$ymaxtext.'" font-size="22">'.$array[$xmax0[0]].'</text>
              <circle cx="'.$xmax.'" cy="'.min($y).'" r="4" fill="#FF4749"></circle>
              ';
          }

          $xdate1 = $x[0] - 45;
          $xdate2 = $x[count($x)-1] - 60;
          $ydate = $height + 40;

          $startdate = new DateTime(date('Y-m-d'));
          $startdate->sub(new DateInterval('P'.(count($x)-1).'D'));

          echo '
            <text x="'.$xdate1.'" y="'.$ydate.'" font-size="24">'.$startdate->format('d.m.Y').'</text>
            <text x="'.$xdate2.'" y="'.$ydate.'" font-size="24">'.date("d.m.Y").'</text>

            Der Browser unterstützt kein SVG. Internet Explorer Nutzern ist nicht mehr zu helfen.

              <style media="screen">
              polygon {
                fill: url(#grad);
              }
              text {
                font-family: "Calibri", sans-serif;
              }
            </style>
          </svg>

          ';

        }

    }
