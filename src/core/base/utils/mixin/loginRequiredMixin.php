<?php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                $_SESSION['rememberUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                header('Location: '.AuthModel::getLoginUrl());
                exit;
            }

        }

    }