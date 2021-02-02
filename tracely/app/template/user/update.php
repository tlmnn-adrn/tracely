
<?php ob_start(); ?>

<h1>Update User <?= $object->getField('vorname') ?></h1>

<form action="" method="post">
  <?=$object->renderField("vorname", "Vorname", "Vorname")?><br>
  <?=$object->renderField("nachname", "Nachname", "Nachname")?><br>
  <?=$object->renderField("plz", "Postleitzahl", "Postleitzahl")?><br>
  <?=$object->renderField("email", "E-Mail Adresse", "E-Mail Adresse")?><br>
  <?=$object->renderField("passwort", "Passwort", "Passwort", "", "update")?><br>
  <button type="submit" name="button">Ändern</button>
</form>

<?php $body = ob_get_clean(); ?>

<?php

  $title = "Update User ".$object->getField('vorname');

  require($this->extend('base.php'));
?>