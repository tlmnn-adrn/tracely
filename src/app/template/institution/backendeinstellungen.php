<?php
#Template für die Institutionseinstellungen
  $title = 'tracely | Einstellungen';
  $styles = ['login/style-login.css', 'backend/style-backendeinstellungen.css', 'backend/style-backendeinstellungen-layout.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div id="einstellungen">
              <?php
              if ($success) {
                echo '<div class="Success">Einstellungen erfolgreich gespeichert.</div>';
              }
              ?>
              <h1>Einstellungen</h1>
              <div id="einstellungen-content">
                <form action="?" method="post">
                  <?= $this->csrfToken() ?>
                  <h6>Institutionsname</h6>
                  <?=$object->renderField("name", "Muster GmbH", "aInput", "Failure")?><br>
                  <h6>Straße und Hausnummer</h6>
                  <?=$object->renderField("adresse", "Beispiel Allee 12", "aInput", "Failure")?><br>
                  <h6>PLZ</h6>
                  <?=$object->renderField("plz", "01234", "aInput", "Failure")?><br>
                  <h6>Stadt</h6>
                  <?=$object->renderField("stadt", "Musterstadt", "aInput", "Failure")?><br>
                  <h6>E-Mail</h6>
                  <?=$object->renderField("email", "kontakt@muster.de", "aInput", "Failure")?><br>
                  <h6>Institutionsart wählen</h6>
                  <?=$object->renderField("institutionsartId", "Institutionsart wählen", "aInput", "Failure")?><br>
                  <h6>Passwort ändern</h6>
                  <?=$object->renderField("passwort", "Passwort", "aInput", "Failure", "update")?><br>
                  <br>
                  <button type="submit" name="button" class="aButton aButtonInvert">Einstellungen speichern</button>
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
