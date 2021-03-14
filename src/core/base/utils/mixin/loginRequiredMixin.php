<?php

    trait LoginRequiredMixin{

        //Die Seite kann nur aufgerufen werden, wenn der Benutzer angemeldet ist
        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                $_SESSION['rememberUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                header('Location: '.AuthModel::getLoginUrl());
                exit;
            }

        }

    }