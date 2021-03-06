<!DOCTYPE html>
<?php #Template für Fehlermeldungsseite ?>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $errorTitle ?> Fehler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= Url::find('static', 'media/favicon.ico') ?>">
    <link rel='stylesheet' href='<?= Url::find('static', 'style/style.css') ?>'>
    <link rel='stylesheet' href='<?= Url::find('static', 'style/style-layout.css') ?>'>
    <link rel='stylesheet' href='<?= Url::find('static', 'style/error/style-error.css') ?>'>
  </head>
  <body>

    <div id="error-content">
      <a href="<?= Url::find('index') ?>"><h4>trace<span>ly</span></h4></a>
      <h1><?= $errorTitle ?> Fehler</h1>

      <p><?=$errorMessage?></p>

      <?php
      if (!empty($_SESSION['randomIMG'])) {
        do {
          $randomIMG = rand(1, 7);
        } while ($_SESSION['randomIMG'] == $randomIMG);
      } else {
        $randomIMG = rand(1, 7);
      }
      $_SESSION['randomIMG'] = $randomIMG;
      ?>

      <img src='<?= Url::find('static', 'media/error/'.$randomIMG.'.jpg') ?>' alt="">
    </div>

  </body>
</html>
