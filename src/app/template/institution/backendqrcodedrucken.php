<?php
  $title = 'tracely | Qr-Code drucken';
  $styles = ['backend/style-backend.css', 'backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

<?php
#Quelle: https://stackoverflow.com/questions/5943368/dynamically-generating-a-qr-code-with-php
  $link = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$_SERVER['HTTP_HOST'].'/scan/erstellen/'.$code.'&choe=UTF-8';
?>

<div class="BackendBox" id="kontaktverfolgung">

  <h3 style="color: #FF4749;">Kontaktpersonennachverfolgung</h3>
  <img src="<?= $link ?>" title="Link to Google.com" />
  <br>
  <div>
    <table style="width: 260px; padding-left: 40px;">
      <tr>
        <td style="width: 48%; text-align: left;"><?= $qrcode[0][6] ?></td>
        <td style="width: 48%; text-align: right;">T-Nr.: <?= $qrcode[0]['tischnummer'] ?></td>
      </tr>
    </table>
  </div>

</div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
