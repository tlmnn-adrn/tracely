<?php
  $title = 'tracely | Qr-Code drucken';
  $styles = ['backend/style-backend.css', 'backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

<?php
  $link = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data='.urlencode(Url::find('scan-erstellen', $code));
?>

<div class="BackendBox" id="kontaktverfolgung">

  <h3 style="color: #FF4749;">Kontaktpersonennachverfolgung</h3>
  <img src="<?= $link ?>" />
  <br>
  <div>
    <table style="width: 260px; padding-left: 40px;">
      <tr>
        <td style="width: 48%; text-align: left;"><?= $qrcode[6] ?></td>
        <td style="width: 48%; text-align: right;">T-Nr.: <?= $qrcode['tischnummer'] ?></td>
      </tr>
    </table>
  </div>

</div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
