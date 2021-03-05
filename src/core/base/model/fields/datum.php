<?php

    class DatumField extends BaseField implements Field{

        protected $template = "datum.php";

        function checkValid(){

            return parent::checkValid();

        }

    }
