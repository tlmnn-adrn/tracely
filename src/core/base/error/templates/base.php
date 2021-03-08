<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $errorTitle ?> Fehler</title>
    <link rel="shortcut icon" href="<?= Url::find('static', 'media/favicon.ico') ?>">
    <link rel='stylesheet' href='<?= Url::find('static', 'style/style.css') ?>'>
    <link rel='stylesheet' href='<?= Url::find('static', 'style/error/style-error.css') ?>'>
  </head>
  <body>

    <div id="error-content">
      <a href="<?= Url::find('index') ?>"><h4>trace<span>ly</span></h4></a>
      <h1><?= $errorTitle ?> Fehler</h1>

      <p><?=$errorMessage?></p>

      <img src='<?= Url::find('static', 'media/error/'.rand(1, 4).'.jpg') ?>' alt="">
    </div>

  </body>
</html>
