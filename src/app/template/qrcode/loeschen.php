<?php
#Template für QR-Code löschen
  $title = 'tracely | QR-Code löschen';
  $styles = ['backend/style-backend.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div class="BackendBox" id="qrcodeerstellung">

              <h1>QR-Code löschen</h1>
              <?php if($code) { ?>

              <h3>Informationen zum QR-Code:</h3>
                <ul>
                  <li>Tischnummer: <?= $code->tischnummer ?></li>
                  <li>Sitzplätze: <?= $code->sitzplätze ?></li>
                  <li><i>QR-Code ID: <?= $code->id ?></i></li>
                </ul>
                <br>
                <h3>Sind Sie sich sicher diesen QR-Code zu löschen?</h3>
              <form action="" method="post">
                <?= $this->csrfToken() ?>
                <button type="submit" name="qrcodeloeschenF" class="aButton aButtonInvert" value="<?= $code->id ?>">QR-Code löschen</button>
                <a href="<?= Url::find('backend-institution') ?>" class="aButton">Abbrechen</a>
              </form>

            <?php } else {echo '<p class="Failure">Zugriff verweigert.</p>'; } ?>

            </div>

          </div>
        </div>


      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
