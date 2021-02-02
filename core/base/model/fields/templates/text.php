<label for="<?=$name?>Field"><?=$label?></label>
<input type="text" id="<?=$name?>Field"  name="<?=$name?>" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">

<?php foreach($this->errors as $error): ?>
    <?=$error?><br>
<?php endforeach; ?>