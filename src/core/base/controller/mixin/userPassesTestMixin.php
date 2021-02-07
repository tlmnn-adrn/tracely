<?php

    trait UserPassesTestMixin{

        abstract function testFunc();

        function userPassesTestMixinInit($arguments=[]){

            if(!$this->testFunc(...$arguments)){
                new BaseError('404', 'Du darfst diese Seite nicht ansehen', 404);
            }

        }

    }