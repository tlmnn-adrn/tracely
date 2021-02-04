<?php

    trait LoginRedirectMixin{

        function loginRedirectMixinInit($arguments=[]){

            if(AuthModel::isLoggedIn()){
                header('Location: '.$this->url($_ENV['LoginSuccessUrl']));
                exit;
            }

        }

    }