<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User: <?= $context["object"]->getField("vorname") ?></title>
  </head>
  <body>
    <h1>Hallo <?= $context["object"]->getField("nachname") ?></h1>
  </body>
</html>
