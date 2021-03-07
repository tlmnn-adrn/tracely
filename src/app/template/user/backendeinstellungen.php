<?php
  $title = 'tracely | Einstellungen';
  $styles = ['backend/style-backend.css', 'login/style-login.css', 'backend/style-backendeinstellungen.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div id="backend-willkommen">
              <?php
              if ($success) {
                echo '<div class="Success">Einstellungen erfolgreich gespeichert.</div>';
              }

              ?>
              <h1>Einstellungen</h1>
              <div id="einstellungen-content">
                <form action="?" method="post">
                  <?= $this->csrfToken() ?>
                  <h6>Vorname</h6>
                  <?=$object->renderField("vorname", "Max", "aInput", "Failure")?><br>
                  <h6>Nachname</h6>
                  <?=$object->renderField("nachname", "Mustermann", "aInput", "Failure")?><br>
                  <h6>E-Mail</h6>
                  <?=$object->renderField("email", "max@mustermann.tld", "aInput", "Failure")?><br>
                  <h6>Telefonnumer</h6>
                  <?=$object->renderField("telefonnummer", "0123 4567890", "aInput", "Failure")?><br>
                  <h6>PLZ des Wohnortes</h6>
                  <?=$object->renderField("plz", "01234", "aInput", "Failure")?><br>
                  <h6>Passwort</h6>
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
