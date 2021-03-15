<?php

    trait UserLoginRequiredMixin{

        //Die Seite kann nur aufgerufen werden, wenn eine Privatperson angemeldet ist
        function userLoginRequiredMixinInit($arguments=[]){

            if(!UserModel::isLoggedIn()){
                $_SESSION['rememberUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                header('Location: '.UserModel::getLoginUrl());
                exit;
            }

        }

    }
