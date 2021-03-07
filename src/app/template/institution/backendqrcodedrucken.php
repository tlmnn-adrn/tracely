<?php
  $title = 'tracely | Qr-Code drucken';
  $styles = ['backend/style-backend.css', 'backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

<div class="BackendBox" id="kontaktverfolgung">
  <h1 class='Test'>QR-Code drucken</h1>
  <?php
    $link = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F'.$_SERVER['HTTP_HOST'].'/scan/erstellen/'.$qrcode[0]['code'].'&choe=UTF-8';
  ?>
  <img src="<?= $link ?>" title="Link to Google.com" />


</div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
