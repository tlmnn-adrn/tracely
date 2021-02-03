<?php 
  $title = 'User';
  $styles = [];

  ob_start();
?>

  <h1>
    User: <?=$object->getField('vorname')?> <?=$object->getField('nachname')?>
  </h1>

<?php $body = ob_get_clean(); ?>


<?php
  require($this->extend('base.php'));
?>
