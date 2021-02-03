<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel='stylesheet' href='static/style/styles.css'>

    <?php if(isset($styles)): ?>
        <?php foreach($styles as $style): ?>
            <link rel='stylesheet' href='static/style/<?=$style?>'>
        <?php endforeach ?>
    <?php endif ?>

    <title><?=$title?></title>
</head>
<body>
    <?=$body?>
</body>
</html>