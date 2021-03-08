<?php
  $title = 'tracely | Übersicht';
  $styles = ['backend/style-backend.css', 'backend/style-backendubersicht.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div class="BackendBox" id="backend-willkommen">
              <?php
              if ($success) {
                echo '<div class="Success">'.$success.'</div>';
              }
              ?>
              <h1>Willkommen <?= $object->name ?></h1>
              <h3>Schnellzugriff</h3>
              <p>
                <a href="<?= Url::find('backend-institution-qrcodeerstellung') ?>" class="aButton">QR-Code erstellen</a>
                <a href="<?= Url::find('backend-institution-kontaktverfolgung') ?>" class="aButton">Kontaktverfolgung</a>
              </p>
            </div>

            <div class="BackendBox" id="tischubersicht">
              <h3>Qr-Codeübersicht</h3>
              <table>
                <tr>
                  <th>Tischnummer</th><th>Sitzplätze</th><th>QR-Code Optionen</th>
                </tr>
                <?php
                for ($i=0; $i < count($qrcodes); $i++) {
                ?>
                  <tr>
                    <td><?= $qrcodes[$i]->tischnummer?> </td>
                    <td><?=$qrcodes[$i]->sitzplätze?></td>
                    <td><a href="<?=Url::find("backend-institution-qrcodedrucken", $qrcodes[$i]->code)?>" target="_blank" class="aText">erneut drucken</a></td>
                    <td>
                      <a href="<?=Url::find("backend-institution-qrcodelöschen", $qrcodes[$i]->id)?>" class="aText">löschen</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </table>

            </div>

            <div class="BackendBox" id="backend-willkommen">
              <h3>Scananzahl der letzten Woche</h3>
              <br><br>
              <div id="zahlen">
                <?php

                $max = max(1, max($scans));

                $width = 800;
                $height = 250;

                for ($i=0; $i < count($scans); $i++) {
                  $y[$i] = ($height - 1) - (($scans[$i] / $max) * ($height-40));
                }
                for ($n=0; $n < count($scans); $n++) {
                  $x[$n] = $n * ($width / (count($scans)-1)) + 10;
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
                  <text x="'.$x[$o].'" y="'.$ytext.'" font-size="20">'.$scans[$o].'</text>
                  <circle cx="'.$x[$o].'" cy="'.$y[$o].'" r="4" fill="#FF4749"></circle>
                  ';

                }

                echo '
                  Der Browser unterstützt kein SVG. Internet Explorer Nutzern ist nicht mehr zu helfen.
                </svg>
                ';

                ?>


              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
