<?php #Template zum Eingabefeld: Passwort ?>

<?php switch($type):
    case 'update': ?>

        <input type="password" id="Altes<?=$name?>Field" name="<?=$name?>Alt" placeholder="<?php if ($placeholder!=""): ?>Altes <?=$placeholder?><?php endif ?>" class="<?=$class?>"><br>

        <input type="password" id="Neues<?=$name?>Field" name="<?=$name?>" placeholder="<?php if ($placeholder!=""): ?>Neues <?=$placeholder?><?php endif ?>" class="<?=$class?>"><br>

        <input type="password" id="Neues<?=$name?>WiederholenField" name="<?=$name?>Wiederholen" placeholder="<?php if ($placeholder!=""): ?>Neues <?=$placeholder?> wiederholen<?php endif ?>" class="<?=$class?>">

    <?php break; ?>
    <?php case 'register': ?>

        <input type="password" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" class="<?=$class?>"><br>

        <input type="password" id="<?=$name?>WiederholenField" name="<?=$name?>Wiederholen" placeholder="<?php if ($placeholder!=""): ?><?=$placeholder?> wiederholen<?php endif ?>" class="<?=$class?>">

    <?php break; ?>
    <?php default: ?>

        <input type="password" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" class="<?=$class?>">

<?php endswitch; ?>

<?php if(count($this->errors)): ?>
    <div class="<?=$errorClass?>">
        <?php foreach($this->errors as $error): ?>
            <?=$error?><br>
        <?php endforeach; ?>
    </div>
<?php endif?>
