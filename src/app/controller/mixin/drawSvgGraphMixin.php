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

          $widthframe = $width + 20;
          $heightframe = $height + 20;

          echo '
          <svg id="test" width="'.$widthframe.'px" height="'.$heightframe.'px">
            <polyline fill="none" stroke="#FF4749" stroke-width="2" points="
            '.$points.'
            "></polyline>
          ';
          /*
          for ($l=0; $l < count($x); $l++) {
            echo '
            <polyline fill="none" stroke="hsl(0, 0%, 60%)" stroke-width="2" stroke-dasharray="10,5" points="
            '.$x[$l].',0 '.$x[$l].','.$height.'
            "></polyline>
            ';

          }*/

          for ($o=0; $o < count($y); $o++) {
            $ytext = $y[$o] - 10;
            echo '
            <text x="'.$x[$o].'" y="'.$ytext.'" font-size="20">'.$array[$o].'</text>
            <circle cx="'.$x[$o].'" cy="'.$y[$o].'" r="4" fill="#FF4749"></circle>
            ';

          }

          echo '
            Der Browser unterstützt kein SVG. Internet Explorer Nutzern ist nicht mehr zu helfen.
          </svg>
          ';
        }

    }
