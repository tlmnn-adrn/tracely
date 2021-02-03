<?php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                header('Location: '.$_ENV['LoginUrl']);
                exit;
            }

        }

    }