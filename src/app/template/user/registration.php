<?php
  $title = 'tracely | Registrierung';
  $styles = ['login/style.css', 'login/style-layout.css', 'login/style-registration.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="login">
              <h1>- Privatpersonenregistrierung -</h1>

              <div id="login-content">
                <form action="" method="post">
                  <?= $this->csrfToken() ?>
                  <h6>Vorname</h6>
                  <?=$object->renderField("vorname", "Max", "aInput")?><br>
                  <h6>Nachname</h6>
                  <?=$object->renderField("nachname", "Mustermann", "aInput")?><br>
                  <h6>E-Mail</h6>
                  <?=$object->renderField("email", "max@mustermann.tld", "aInput")?><br>
                  <h6>Telefonnumer</h6>
                  <?=$object->renderField("telefonnummer", "0123 4567890", "aInput")?><br>
                  <h6>PLZ des Wohnortes</h6>
                  <?=$object->renderField("plz", "01234", "aInput")?><br>
                  <h6>Passwort</h6>
                  <?=$object->renderField("passwort", "Passwort", "aInput", "", "register")?><br>

                  <div class="LoginContentBottom" id="login-content-bottom-left"><a class="aList" href="<?= Url::find('login-user') ?>">bereits registriert?</a></div>
                  <div class="LoginContentBottom" id="login-content-bottom-right"><button type="submit" name="button" class="aButton aButtonInvert">Registrieren</button></div>
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
