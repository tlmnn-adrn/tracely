<?php
  $title = 'tracely | Registrierung';
  $styles = ['login/style.css', 'login/style-layout.css', 'login/style-registration.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="login">
              <h1>- Registrieren als -</h1>

              <div id="login-content">
                <div class="LoginContentBottom" id="login-content-bottom-left"><a class="aButton" href="<?= Url::find('registrierung-institution') ?>">Institution</a></div>
                <div class="LoginContentBottom" id="login-content-bottom-right"><a class="aButton" href="<?= Url::find('registrierung-user') ?>">Privatperson</a></div>
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
