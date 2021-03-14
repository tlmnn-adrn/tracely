<?php #Template zum Eingabefeld: E-Mail ?>

<input type="email" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">

<?php if(count($this->errors)): ?>
    <div class="<?=$errorClass?>">
        <?php foreach($this->errors as $error): ?>
            <?=$error?><br>
        <?php endforeach; ?>
    </div>
<?php endif?>
