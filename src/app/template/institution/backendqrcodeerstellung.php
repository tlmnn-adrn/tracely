<?php
  $title = 'tracely | QR-Code Erstellung';
  $styles = ['backend/style-backend.css', 'backend/style-backendqrcodeerstellung.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div class="BackendBox" id="qrcodeerstellung">
              <?php
              if ($success) {
                echo '<div class="Success">QR-Code erfolgreich erstellt.</div>';
              }
              ?>
              <h1>Qr-Code Erstellung</h1>
              <form action="?" method="post">
                <?=$code->renderField("tischnummer", "Tischnummer", "aInput")?>
                <?=$code->renderField("sitzplätze", "Sitzplätze", "aInput")?><br>
                <button type="submit" name="button" class="aButton aButtonInvert">QR-Code erstellen</button>
              </form>
            </div>

          </div>
        </div>


      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
