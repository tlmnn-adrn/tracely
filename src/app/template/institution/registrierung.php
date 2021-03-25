<?php
#Template für die Institutionsregistrierung
  $title = 'tracely | Registrierung';
  $styles = ['login/style.css', 'login/style-layout.css', 'login/style-registrierung.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="login">
              <h1>- Institutionsregistrierung -</h1>

              <div id="login-content">
                <form action="" method="post">
                  <?= $this->csrfToken() ?>
                  <h6>Institutionsname</h6>
                  <?=$object->renderField("name", "Muster GmbH", "aInput")?><br>
                  <h6>Straße Hausnummer</h6>
                  <?=$object->renderField("adresse", "Beispiel Allee 12", "aInput")?><br>
                  <h6>PLZ</h6>
                  <?=$object->renderField("plz", "01234", "aInput")?><br>
                  <h6>Stadt</h6>
                  <?=$object->renderField("stadt", "Musterstadt", "aInput")?><br>
                  <h6>E-Mail</h6>
                  <?=$object->renderField("email", "kontakt@muster.tdl", "aInput")?><br>
                  <h6>Institutionsart wählen</h6>
                  <?=$object->renderField("institutionsartId", "Institutionsart wählen", "aInput")?><br>
                  <h6>Passwort</h6>
                  <?=$object->renderField("passwort", "Passwort", "aInput", "", "register")?><br>

                  <div class="LoginContentBottom" id="login-content-bottom-left"><a class="aList" href="<?= Url::find('login-institution') ?>">bereits registriert?</a></div>
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
