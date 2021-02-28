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
              <h1>Qr-Code Erstellung</h1>
              <form action="?" method="post">
                <?=$object->renderField("name", "Tischnummer", "aInput")?>
                <?=$object->renderField("name", "TT.MM.JJJJ", "aInput")?><br>
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
