<?php
#Template für die Onlineanwendung zum Scan eines QR-Codes
  $title = 'tracely | Online Scan';
  $styles = [];

  ob_start();
?>

<script src="<?=Url::find('static', 'js/qr/scan.js')?>"></script>
<video id="videoOutput"></video>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
