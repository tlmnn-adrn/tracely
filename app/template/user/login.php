
<?php ob_start(); ?>

<h1>Login</h1>

<form action="" method="post">
  <?=$object->renderField("email", "E-Mail Adresse", "E-Mail Adresse")?><br>
  <?=$object->renderField("passwort", "Passwort", "Passwort", "", "")?><br>
  <button type="submit" name="button">Ändern</button>
</form>

<?php $body = ob_get_clean(); ?>

<?php

    $title = "Login";
    require($this->extend('base.php'));
    
?>