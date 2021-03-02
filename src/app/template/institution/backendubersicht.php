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
              <h1>Willkommen <?= $object->name ?></h1>
              <h3>Schnellzugriff</h3>
              <p>
                <a href="<?= Url::find('backend-institution-qrcodeerstellung') ?>" class="aButton">QR-Code erstellen</a>
                <a href="<?= Url::find('backend-institution-kontaktverfolgung') ?>" class="aButton">Kontaktverfolgung</a>
              </p>
            </div>

            <div class="BackendBox" id="tischubersicht">
              <h3>Tischübersicht</h3>
              <table>
                <tr>
                  <th>Tischnummer</th><th>Sitzplätze</th><th>QR-Code Optionen</th>
                </tr>
                <?php

                for ($i=0; $i < count($qrcodes); $i++) {
                  echo '
                  <tr>
                    <td>'.$qrcodes[$i]->tischnummer.'</td>
                    <td>'.$qrcodes[$i]->sitzplaetze.'</td>
                    <td> erneut drucken </td>
                    <td> löschen </td>
                  </tr>
                  ';
                }

                ?>
              </table>

            </div>

          </div>
        </div>


      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
