<?php

    class IdField extends IntegerField implements Field{

        function __construct(){
    
            parent::__construct(TRUE, TRUE);
            
        }

        function updateValue($value, $unique){

            $this->errors[] = $this->errorTypes['setIdError'];

            return FALSE;

        }

    }