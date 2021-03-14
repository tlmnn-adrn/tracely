<!DOCTYPE html>
<?php
#Template des 1. HTML Frames
//beinhaltet die HTML Struktur, die Informationen zum Head und bettet den body der Templates ein
?>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="<?= Url::find('static', 'js/headerscroll.js') ?>"></script>
    <script src="<?= Url::find('static', 'js/start.js') ?>"></script>
    <script src="<?= Url::find('static', 'js/showhide.js') ?>"></script>
    <link rel="shortcut icon" href="<?= Url::find('static', 'media/favicon.ico') ?>">

    <link rel='stylesheet' href='<?= Url::find('static', 'style/style.css') ?>'>
    <link rel='stylesheet' href='<?= Url::find('static', 'style/style-layout.css') ?>'>

    <?php if (AuthModel::isLoggedIn()): ?>
      <link rel='stylesheet' href='<?= Url::find('static', 'style/backend/style-backend.css') ?>'>
    <?php endif ?>
    <?php if(isset($styles)): ?>
        <?php foreach($styles as $style): ?>
            <link rel='stylesheet' href='<?= Url::find('static', 'style/'.$style) ?>'>
        <?php endforeach ?>
    <?php endif ?>

    <title><?=$title?></title>

  </head>
  <body onload="start()" contextmenu="return false">

    <?=$body?>

  </body>
</html>
