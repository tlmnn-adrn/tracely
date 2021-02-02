<?php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!UserModel::isLoggedIn()){
                header('Location: '.$_ENV['LoginUrl']);
                exit;
            }

        }

    }