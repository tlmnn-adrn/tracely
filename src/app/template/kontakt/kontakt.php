<?php
#Template für die Kontaktseite
  $title = 'tracely | Kontakt';
  $styles = ['impressum/style-impressum.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="kontakt">
              <h1>Kontakt</h1>
              <p>
                Bitte kontaktieren Sie uns unter folgender E-Mail:
                <br><br>
                kontakt@tracely.de
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
