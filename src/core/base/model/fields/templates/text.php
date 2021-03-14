<?php #Template zum Eingabefeld: Text ?>

<input type="text" id="<?=$name?>Field"  name="<?=$name?>" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">

<?php if(count($this->errors)): ?>
    <div class="<?=$errorClass?>">
        <?php foreach($this->errors as $error): ?>
            <?=$error?><br>
        <?php endforeach; ?>
    </div>
<?php endif?>
