<?php

    trait UserLoginRequiredMixin{

        function userLoginRequiredMixinInit($arguments=[]){

            if(!UserModel::isLoggedIn()){
                header('Location: '.UserModel::getLoginUrl());
                exit;
            }

        }

    }