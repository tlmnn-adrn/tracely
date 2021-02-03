<?php

    trait UserLoginRequiredMixin{

        function userLoginRequiredMixinInit($arguments=[]){

            if(!UserModel::isLoggedIn()){
                header('Location: '.$_ENV['LoginUrl']);
                exit;
            }

        }

    }