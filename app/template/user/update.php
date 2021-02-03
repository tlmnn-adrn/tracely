
<?php 

  $title = "Update User ".$object->getField('vorname');

  ob_start(); 

?>

  <h1>Update User <?= $object->getField('vorname') ?></h1>

  <form action="" method="post">
    <?=$object->renderField("vorname", "Vorname", "Vorname")?><br>
    <?=$object->renderField("nachname", "Nachname", "Nachname")?><br>
    <?=$object->renderField("plz", "Postleitzahl", "Postleitzahl")?><br>
    <?=$object->renderField("email", "E-Mail Adresse", "E-Mail Adresse")?><br>
    <?=$object->renderField("passwort", "Passwort", "Passwort", "", "update")?><br>
    <button type="submit" name="button">Ändern</button>
  </form>

  <?php if(isset($success) && $success): ?>
    <div class="" id="" style="color:green">
      Daten erfolgreich geupdatet
    </div>
  <?php endif?>

<?php $body = ob_get_clean(); ?>




<?php
  require($this->extend('base.php'));
?>