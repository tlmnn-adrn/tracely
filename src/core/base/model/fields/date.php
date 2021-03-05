<?php

    class DateField extends BaseField implements Field{

        protected $template = "date.php";

        function checkValid(){

            //Quelle
            if(DateTime::createFromFormat('Y-m-d h:m:s', $this->value) == FALSE){
                return FALSE;
            }

            return parent::checkValid();

        }

        function render($name, $placeholder="", $class="", $errorClass="", $time=FALSE){

            //Aufrufen des dazugehörigen Templates und anzeigen
            $path = 'core/base/model/fields/templates/'.$this->template;
            require($path);

        }

    }
