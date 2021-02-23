<?php

class PasswordField extends BaseField implements Field{

    //Attribut für die Mindestlänge des Passwortes
    //Standartmäßig 6

    protected $template = 'password.php';
    
    function __construct(protected $minLength=6){
        
        return parent::__construct(FALSE, FALSE);
        
    }

    function set($value){

        if($this->value){
            throw new BaseError('Interner', 'Um den Wert des Passwort-Feldes zu ändern, benutze die Methode setPassword()!', 500);

            return FALSE;
        }

        parent::set($value);

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
    function checkValid($value=''){

        if(strlen($value)<$this->minLength){
            
            $this->errors[] = $this->errorTypes['passwordShortError'];

        }

        return parent::checkValid();

    }

    //Hashen des eingegebenen Passwortes
    function hash($value){
        return password_hash($value, PASSWORD_DEFAULT);
    }

    //Überschreiben des gespeicherten Passwortes mit einem neuen
    //Dabei wird auch überprüft, ob das Passwort beim wiederholen identisch war
    //und ob das alte Passwort korrekt war
    function setPassword($value, $repeatValue='', $oldValue=''){
        
        //Stimmen die Beiden neuen Passwörter nicht überein, wird eine Fehlermeldung gespeichert und der weitere Vorgang abgebrochen
        if($repeatValue!=$value){

            $this->errors[] = $this->errorTypes['passwordsDontMatchError'];

        }
        
        //Ist das alte Passwort falsch, wird eine Fehlermeldung gespeichert und der weitere Vorgang abgebrochen
        if(!$this->equals($oldValue)){
            $this->errors[] = $this->errorTypes['oldPasswordWrongError'];

        }

        //Sollte das neue Passwort den Mindestanforderungen genügen, wird es in gehashter Form in den Attributen gespeichert
        $this->checkValid($value);

        if(!$this->hasErrors()){
            $this->value = $this->hash($value);
        }

    }

    function hasErrors(){
        return count($this->errors) > 0;
    }

    //Rendern des Templates, aber mit veränderter Parameterliste
    function render($name, $placeholder="", $class="", $type=""){
                
        $path = 'core/base/model/fields/templates/'.$this->template;
        require($path);

    }

}