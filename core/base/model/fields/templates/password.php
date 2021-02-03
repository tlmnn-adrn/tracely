
<?php switch($type): 
    case 'update': ?>
    
        <label for="Altes<?=$name?>Field"><?php if ($label!=""): ?>Altes <?=$label?><?php endif ?></label>
        <input type="password" id="Altes<?=$name?>Field" name="<?=$name?>Alt" placeholder="<?php if ($placeholder!=""): ?>Altes <?=$placeholder?><?php endif ?>" class="<?=$class?>"><br>

        <label for="Neues<?=$name?>Field"><?php if ($label!=""): ?>Neues <?=$label?><?php endif ?></label>
        <input type="password" id="Neues<?=$name?>Field" name="<?=$name?>" placeholder="<?php if ($placeholder!=""): ?>Neues <?=$placeholder?><?php endif ?>" class="<?=$class?>"><br>

        <label for="Neues<?=$name?>WiederholenField"><?php if ($label!=""): ?>Neues <?=$label?> Wiederholen<?php endif ?></label>
        <input type="password" id="Neues<?=$name?>WiederholenField" name="<?=$name?>Wiederholen" placeholder="<?php if ($placeholder!=""): ?>Neues <?=$placeholder?> Wiederholen<?php endif ?>" class="<?=$class?>">

    <?php break; ?>
    <?php case 'register': ?>
    
        <label for="<?=$name?>Field"><?=$label?></label>
        <input type="password" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" class="<?=$class?>"><br>

        <label for="<?=$name?>WiederholenField"><?php if ($label!=""): ?><?=$label?> Wiederholen<?php endif ?></label>
        <input type="password" id="<?=$name?>WiederholenField" name="<?=$name?>Wiederholen" placeholder="<?php if ($placeholder!=""): ?><?=$placeholder?> Wiederholen<?php endif ?>" class="<?=$class?>">

    <?php break; ?>
    <?php default: ?>

        <label for="<?=$name?>Field"><?=$label?></label>
        <input type="password" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" class="<?=$class?>">

<?php endswitch; ?>

<?php foreach($this->errors as $error): ?>
    <?=$error?><br>
<?php endforeach; ?>

