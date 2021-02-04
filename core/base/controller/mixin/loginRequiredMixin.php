<?php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                header('Location: '.$this->url($_ENV['LoginUrl']));
                exit;
            }

        }

    }