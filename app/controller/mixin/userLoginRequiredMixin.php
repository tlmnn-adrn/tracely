<?php

    trait UserLoginRequiredMixin{

        function userLoginRequiredMixinInit($arguments=[]){

            if(!UserModel::isLoggedIn()){
                header('Location: '.$this->url($_ENV['LoginUrl']));
                exit;
            }

        }

    }