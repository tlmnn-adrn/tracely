<?php

    trait LoginRedirectMixin{

        function loginRedirectMixinInit($arguments=[]){

            if(AuthModel::isLoggedIn()){
                header('Location: '.$_ENV['LoginSuccessUrl']);
                exit;
            }

        }

    }