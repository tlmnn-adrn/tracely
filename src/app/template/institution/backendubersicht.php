<?php
  $title = 'tracely | Ubersicht';
  $styles = ['login/style.css', 'login/style-login.css'];

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
                <a href="#" class="aButton">QR-Code erstellen</a>
                <a href="<?= Url::find('backend-institution-kontaktverfolgung') ?>" class="aButton">Kontaktverfolgung</a>
              </p>
            </div>

            <div class="BackendBox" id="tischubersicht">
              <h3>Tischübersicht</h3>
              <p>lol</p>
            </div>

            <div class="BackendBox" id="kontaktverfolgung">
              <h3>Kontaktverfolgung</h3>
              <div class="KontaktverfolgungBox">
                <h4>Datum</h4>
                <p>Wählen Sie ein Datum, um sich alle Besucher Ihrer Institution an diesem Tag anzeigen zu lassen.</p>
                <form action="?" method="post">
                  <?=$object->renderField("name", "TT.MM.JJJJ", "aInput")?><br>
                  <button type="submit" name="button" class="aButton aButtonInvert">Besucher anzeigen</button>
                </form>
              </div>
              <div class="KontaktverfolgungBox">
                <h4>Tischnummer</h4>
                <p>Wählen Sie eine Tischnummer, um sich alle Besucher Ihrer Institution an diesem Tisch zum gewählten DAtum anzeigen zu lassen.</p>
                <form action="?" method="post">
                  <?=$object->renderField("name", "TT.MM.JJJJ", "aInput")?>
                  <?=$object->renderField("name", "Tischnummer", "aInput")?><br>
                  <button type="submit" name="button" class="aButton aButtonInvert">Besucher anzeigen</button>
                </form>
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
