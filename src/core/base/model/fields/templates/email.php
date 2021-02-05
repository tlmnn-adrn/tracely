
<input type="email" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" value="<?=$this->value?>" class="<?=$class?>">

<?php foreach($this->errors as $error): ?>
    <?=$error?><br>
<?php endforeach; ?>