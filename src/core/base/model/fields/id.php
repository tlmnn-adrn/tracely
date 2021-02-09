<?php

    class IdField extends IntegerField implements Field{

        function __construct(){
    
            parent::__construct(TRUE, TRUE);
            
        }

        function set($value){

            if($this->value){
                throw new BaseError('Interner', 'Du solltest den Wert des Id-Feldes nicht ändern.', 500);

                return FALSE;
            }

            parent::set($value);

        }

    }