<?php

class PasswordField extends BaseField implements Field{

    protected $minLength;

    protected $template = 'password.php';
    
    function __construct($value='', $minLength=6){
        
        $this->minLength = $minLength;
        return parent::__construct($value, TRUE, FALSE);
        
    }

    function equals($value){

        if($this->value==""){
            return TRUE;
        }
        
        return password_verify($value, $this->value);
    }

    function checkValid($value){

        if(strlen($value)<$this->minLength){
            
            $this->errors[] = $this->errorTypes['passwordShortError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

    function hash($value){
        return password_hash($value, PASSWORD_DEFAULT);
    }

    function updateValue($value, $unique, $repeatValue='', $oldValue=''){

        if($repeatValue!=$value){

            $this->errors[] = $this->errorTypes['passwordsDontMatchError'];

            return FALSE;
        }

        if(!$this->equals($oldValue)){

            $this->errors[] = $this->errorTypes['oldPasswordWrongError'];

            return FALSE;
        }

        if($this->checkValid($value)){
            $value = $this->hash($value);
            $this->setValue($value);
            return TRUE;
        }

        return FALSE;

    }

    function render($name, $placeholder="", $label="", $class="", $type=""){
                
        $path = 'base/model/fields/templates/'.$this->template;
        require($path);

    }

}