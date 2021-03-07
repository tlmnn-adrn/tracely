<?php

    trait UserPassesTestMixin{

        abstract function testFunc();

        function userPassesTestMixinInit($arguments=[]){

            if(!$this->testFunc(...$arguments)){
                new NotFoundError('Sie besitzen keine Berechtigung diese Seite zu sehen.');
            }

        }

    }
