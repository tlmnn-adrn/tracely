
<input type="date" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">

<?php if($time): ?>
    <input type="time" id="<?=$name?>TimeField" name="<?=$name?>Time" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">
<?php endif ?>

<?php if(count($this->errors)): ?>
    <div class="<?=$errorClass?>">
        <?php foreach($this->errors as $error): ?>
            <?=$error?><br>
        <?php endforeach; ?>
    </div>
<?php endif?>