<?php
#Template für die Privatpersonenübersicht im Backendbereich
  $title = 'tracely | Übersicht';
  $styles = ['backend/style-backendubersicht.css', 'backend/style-backendubersicht-layout.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <h1>Willkommen <?= $object->vorname." ".$object->nachname ?></h1>

            <div id="backend-schnellzugriff">
              <h3>Schnellzugriff</h3>
              <p>
                <a href="<?= Url::find('scan-online') ?>" class="aButton" target="_blank">QR-Code scannen</a>
                <a href="<?= Url::find('backend-user-einstellungen') ?>" class="aButton">Einstellungen</a>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
