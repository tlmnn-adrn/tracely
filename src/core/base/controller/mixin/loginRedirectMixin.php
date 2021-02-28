<?php

    trait LoginRedirectMixin{

        function loginRedirectMixinInit($arguments=[]){

            if(AuthModel::isLoggedIn()){
                header('Location: '.AuthModel::getLogoutSuccessUrl());
                exit;
            }

        }

    }
