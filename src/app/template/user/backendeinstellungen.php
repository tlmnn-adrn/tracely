<?php
  $title = 'tracely | Einstellungen';
  $styles = ['backend/style-backend.css', 'login/style-login.css', 'backend/style-backendeinstellungen.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
<svg width="48" height="48" xmlns="http://www.w3.org/2000/svg">

 <g>
  <title>Layer 1</title>
  <path id="svg_1" fill="none" d="m0,0l48,0l0,48l-48,0l0,-48z"/>
  <path id="svg_2" d="m38.86,25.95c0.08,-0.64 0.14,-1.29 0.14,-1.95s-0.06,-1.31 -0.14,-1.95l4.23,-3.31c0.38,-0.3 0.49,-0.84 0.24,-1.28l-4,-6.93c-0.25,-0.43 -0.77,-0.61 -1.22,-0.43l-4.98,2.01c-1.03,-0.79 -2.16,-1.46 -3.38,-1.97l-0.75,-5.3c-0.09,-0.47 -0.5,-0.84 -1,-0.84l-8,0c-0.5,0 -0.91,0.37 -0.99,0.84l-0.75,5.3c-1.22,0.51 -2.35,1.17 -3.38,1.97l-4.98,-2.01c-0.45,-0.17 -0.97,0 -1.22,0.43l-4,6.93c-0.25,0.43 -0.14,0.97 0.24,1.28l4.22,3.31c-0.08,0.64 -0.14,1.29 -0.14,1.95s0.06,1.31 0.14,1.95l-4.22,3.31c-0.38,0.3 -0.49,0.84 -0.24,1.28l4,6.93c0.25,0.43 0.77,0.61 1.22,0.43l4.98,-2.01c1.03,0.79 2.16,1.46 3.38,1.97l0.75,5.3c0.08,0.47 0.49,0.84 0.99,0.84l8,0c0.5,0 0.91,-0.37 0.99,-0.84l0.75,-5.3c1.22,-0.51 2.35,-1.17 3.38,-1.97l4.98,2.01c0.45,0.17 0.97,0 1.22,-0.43l4,-6.93c0.25,-0.43 0.14,-0.97 -0.24,-1.28l-4.22,-3.31zm-14.86,5.05c-3.87,0 -7,-3.13 -7,-7s3.13,-7 7,-7s7,3.13 7,7s-3.13,7 -7,7z"/>
 </g>
</svg>
            <div id="backend-willkommen">
              <?php
              if ($success) {
                echo "Eisntejkldsfj geiafper";
              }

              ?>
              <h1>Einstellungen</h1>
              <div id="einstellungen-content">
                <form action="" method="post">
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
                  <?=$object->renderField("passwort", "Passwort", "aInput", "update")?><br>
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
