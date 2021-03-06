<?php

    trait InstitutionLoginRequiredMixin{

        function institutionLoginRequiredMixinInit($arguments=[]){

            if(!InstitutionModel::isLoggedIn()){
                $_SESSION['rememberUrl'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                header('Location: '.InstitutionModel::getLoginUrl());
                exit;
            }

        }

    }