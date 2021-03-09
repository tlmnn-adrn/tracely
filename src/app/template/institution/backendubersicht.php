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
                <a href="<?= Url::find('qrcode-erstellen') ?>" class="aButton">QR-Code erstellen</a>
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
                    <td><a href="<?=Url::find("qrcode-drucken", $qrcodes[$i]->code)?>" target="_blank" class="aText">erneut drucken</a></td>
                    <td>
                      <a href="<?=Url::find("qrcode-löschen", $qrcodes[$i]->id)?>" class="aText">löschen</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </table>

            </div>

            <div class="BackendBox" id="backend-zahlen">
              <div class="Anker" id="backend-zahlen-anker"></div>
              <h3>Scananzahl der letzten <?= $anzeige ?> Tage</h3>
              <br><br>
              <div id="zahlen">
                <?php $this->drawSvgGraph(array: $scans, width: 760, height: 250);?>
              </div>
              <br><br><br>
              <form action="#backend-zahlen-anker" method="get">
                <button type="submit" name="anzeige" value="7" class="aButton <?= $anzeigeaktiv[7] ?>">7 Tage</button>
                <button type="submit" name="anzeige" value="14" class="aButton <?= $anzeigeaktiv[14] ?>">14 Tage</button>
                <button type="submit" name="anzeige" value="30" class="aButton <?= $anzeigeaktiv[30] ?>">30 Tage</button>
                <button type="submit" name="anzeige" value="60" class="aButton <?= $anzeigeaktiv[60] ?>">60 Tage</button>
                <button type="submit" name="anzeige" value="90" class="aButton <?= $anzeigeaktiv[90] ?>">90 Tage</button>
              </form>
            </div>

          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
