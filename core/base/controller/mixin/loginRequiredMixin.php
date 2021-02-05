<?php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                header('Location: '.AuthModel::getLoginUrl(9));
                exit;
            }

        }

    }