
<input type="number" id="<?=$name?>Field" name="<?=$name?>" placeholder="<?=$placeholder?>" value=<?=$this->value?> class="<?=$class?>">

<?php foreach($this->errors as $error): ?>
    <br><?=$error?>
<?php endforeach; ?>