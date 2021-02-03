<h1>Update User <?= $object->getField('vorname') ?></h1>

<form action="?" method="post">
  Vorname: <input type="text" name="vorname" value='<?= $object->getField('vorname') ?>' required><br>
  Nachname: <input type="text" name="nachname" value='<?= $object->getField('nachname') ?>' required><br>
  altes PW: <input type="text" name="passwordOld" value='' required><br>
  neues PW: <input type="text" name="passwordNew" value='' required><br>
  neues PW wiederholen: <input type="text" name="passwordNewRepeat" value='' required><br>
  <button type="submit" name="button">Ändern</button>
</form>
