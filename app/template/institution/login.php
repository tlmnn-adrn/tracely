<?php
  $title = 'tracely | Login';
  $styles = ['login/style.css', 'login/style-login.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="login">
              <h1>- Institutionslogin -</h1>

              <div id="login-content">
                <form action="" method="post">
                  <?=$object->renderField("email", "E-Mail Adresse", "", "aInput")?><br>
                  <?=$object->renderField("passwort", "Passwort", "", "aInput", "")?><br>
                  <div class="LoginContentBottom" id="login-content-bottom-left"><a class="aList" href="<?= $this->link("")?>registrierung">Registrieren</a></div>
                  <div class="LoginContentBottom" id="login-content-bottom-right"><button type="submit" name="button" class="aButton aButtonInvert">Anmelden</button></div>
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
