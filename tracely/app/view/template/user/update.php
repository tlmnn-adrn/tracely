<h1>Update User</h1>

<form action="?" method="post">
  Vorname: <input type="text" name="vorname" value='<?= $context["object"]->getField("vorname") ?>' required><br>
  Nachname: <input type="text" name="nachname" value='<?= $context["object"]->getField("nachname") ?>' required><br>
  altes PW: <input type="text" name="passwortalt" value='' required><br>
  neues PW: <input type="text" name="passwortneu" value='' required><br>
  neues PW wiederholen: <input type="text" name="passwortneuwdh" value='' required><br>
  <button type="submit" name="button">Ändern</button>
</form>
