<?php
#Template für Erstellung eines Scans
  $title = 'tracely | Scan';
  $styles = ['login/style.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="scan">
              <?php if ($success) { ?>
                <h1 class="Success">QR-Codescan erfolgreich &#10003;</h1>
                <br><br><br>
                <h5>Informationen zum gescannten QR-Code:</h5>
                <p><mark>Institutionsname:</mark> <?= $code[0][6] ?></p>
                <p><mark>Tischnummer:</mark> <?= $code[0]['tischnummer'] ?></p>
                <p><mark>Zeitpunkt:</mark> <?= date("d.m.Y, H:i:s") ?></p>

              <?php } else { ?>
                <h1 class="Failure">QR-Codescan fehlerhaft &#10005;</h1>
                <p>Sie haben bereits diesen Qr-Code im durchschnittlichen Aufenthaltszeitraum von <?= $code[0]['aufenthaltszeit'] ?> min gescannt.</p>
              <?php } ?>


            </div>
          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
