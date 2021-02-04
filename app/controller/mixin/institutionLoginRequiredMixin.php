<?php

    trait InstitutionLoginRequiredMixin{

        function institutionLoginRequiredMixinInit($arguments=[]){

            if(!InstitutionModel::isLoggedIn()){
                header('Location: '.$this->url($_ENV['LoginUrl']));
                exit;
            }

        }

    }