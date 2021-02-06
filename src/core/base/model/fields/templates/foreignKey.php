<select id="<?=$name?>Field" name="<?=$name?>" class="<?=$class?>">

<select id="<?=$name?>Field" name="<?=$name?>" class="<?=$class?>">

    <?php if(strlen($placeholder)>0 && strlen($this->value)==0): ?>
        <option value="" disabled selected><?=$placeholder?></option>
    <?php endif ?>

    <?php foreach($options as $option): ?>
        <option value="<?=$option->getField('id')?>"  <?php if($option->getField('id')==$this->value){echo 'selected';}?>><?=$option?></option>
    <?php endforeach ?>

</select>



<?php foreach($this->errors as $error): ?>
    <?=$error?><br>
<?php endforeach ?>
