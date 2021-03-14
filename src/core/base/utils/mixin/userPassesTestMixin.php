<?php

    //Eine Testfunktion kann vom Programmierer festgelegt werden
    //Returnt diese False, darf der Benutzer die Seite nicht aufrufen
    trait UserPassesTestMixin{

        abstract function testFunc();

        function userPassesTestMixinInit($arguments=[]){

            if(!$this->testFunc(...$arguments)){
                new NotFoundError('Sie besitzen keine Berechtigung diese Seite zu sehen.');
            }

        }

    }
