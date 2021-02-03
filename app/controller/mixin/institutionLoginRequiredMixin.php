<?php

    trait InstitutionLoginRequiredMixin{

        function institutionLoginRequiredMixinInit($arguments=[]){

            if(!InstitutionModel::isLoggedIn()){
                header('Location: '.$_ENV['LoginUrl']);
                exit;
            }

        }

    }