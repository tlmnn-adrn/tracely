<?php
  $title = 'tracely | Registrierung';
  $styles = ['user/style-login.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="login">
              <h1>- Registrierung -</h1>

              <div class="LoginContentBottom" id="login-content-bottom-left"><a class="aButtonInvert" href="registrierung">als Institution <br> registrieren</a></div>
              <div class="LoginContentBottom" id="login-content-bottom-right"><a class="aButtonInvert" href="registrierung">als Privatperson <br> registrieren</a></div>




            </div>
          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
