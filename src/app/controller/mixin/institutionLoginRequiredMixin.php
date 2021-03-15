<?php
#
    trait InstitutionLoginRequiredMixin{

        //Die Seite kann nur aufgerufen werden, wenn eine Institution angemeldet ist
        function institutionLoginRequiredMixinInit($arguments=[]){

            if(!InstitutionModel::isLoggedIn()){
                $_SESSION['rememberUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                header('Location: '.InstitutionModel::getLoginUrl());
                exit;
            }

        }

    }
