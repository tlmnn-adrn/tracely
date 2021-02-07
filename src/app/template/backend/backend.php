<?php
  $title = 'tracely | Backend';
  $styles = ['login/style.css', 'login/style-login.css', 'style-onepage.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <h4>authorisiere...</h4>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
