<?php
  $title = 'tracely | Übersicht';
  $styles = ['backend/style-backend.css', 'backend/style-backendubersicht.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="backend-willkommen">
              <h1>Willkommen <?= $object->vorname." ".$object->nachname ?></h1>
              <h4>Schnellzugriff</h4>
              <p>
                <a href="#" class="aButton">QR-Code scannen</a>
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
