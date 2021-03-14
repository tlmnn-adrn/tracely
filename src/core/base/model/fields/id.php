<?php

    class IdField extends IntegerField{

        //ID Feld ist immer required
        function __construct(){
    
            parent::__construct(TRUE, TRUE);
            
        }

        function set($value){

            //Bei Versuch, den Wert des ID Feldes zu ändern, gibt es eine Fehlermeldung, denn der Wert sollte nicht geändert werden
            if(strlen($this->value)>0){
                throw new BaseError('Interner', 'Du solltest den Wert des Id-Feldes nicht ändern.', 500);

                return FALSE;
            }

            parent::set($value);

        }

    }