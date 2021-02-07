<?php

class PasswordField extends BaseField implements Field{

    //Attribut für die Mindestlänge des Passwortes
    //Standartmäßig 6

    protected $template = 'password.php';
    
    function __construct(protected $minLength=6){
        
        return parent::__construct(TRUE, FALSE);
        
    }

    //Überprüfung, ob das Passwort mit der Eingabe übereinstimmt
    //Muss überschrieben werden, da die Passwörter gehasht in der Datenbank vorliegen
    function equals($value){

        //Sollte noch kein Passwort gesetzt sein (Die dürfte nur beim eintragen eines neuen Elementes in die Datenbank passieren)
        //wird TRUE returnt, da es sonst unmöglich wäre das erstmalige Passwort zu setzen
        if($this->value==""){
            return TRUE;
        }
        
        return password_verify($value, $this->value);
    }

    //Überprügunf, ob das neue Passwort lang genug ist und auch sonst den Bedingungen des BaseFields genügt
    function checkValid($value){

        if(strlen($value)<$this->minLength){
            
            $this->errors[] = $this->errorTypes['passwordShortError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

    //Hashen des eingegebenen Passwortes
    function hash($value){
        return password_hash($value, PASSWORD_DEFAULT);
    }

    //Überschreiben des gespeicherten Passwortes mit einem neuen
    //Dabei wird auch überprüft, ob das Passwort beim wiederholen identisch war
    //und ob das alte Passwort korrekt war
    function updateValue($value, $unique, $repeatValue='', $oldValue=''){

        //Stimmen die Beiden neuen Passwörter nicht überein, wird eine Fehlermeldung gespeichert und der weitere Vorgang abgebrochen
        if($repeatValue!=$value){

            $this->errors[] = $this->errorTypes['passwordsDontMatchError'];

            return FALSE;
        }
        
        //Ist das alte Passwort falsch, wird eine Fehlermeldung gespeichert und der weitere Vorgang abgebrochen
        if(!$this->equals($oldValue)){

            $this->errors[] = $this->errorTypes['oldPasswordWrongError'];

            return FALSE;
        }

        //Sollte das neue Passwort den Mindestanforderungen genügen, wird es in gehashter Form in den Attributen gespeichert
        if($this->checkValid($value)){
            $value = $this->hash($value);
            $this->setValue($value);
            return TRUE;
        }

        return FALSE;

    }

    //Rendern des Templates, aber mit veränderter Parameterliste
    function render($name, $placeholder="", $class="", $type=""){
                
        $path = 'core/base/model/fields/templates/'.$this->template;
        require($path);

    }

}