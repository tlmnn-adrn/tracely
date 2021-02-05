<?php

    trait InstitutionLoginRequiredMixin{

        function institutionLoginRequiredMixinInit($arguments=[]){

            if(!InstitutionModel::isLoggedIn()){
                header('Location: '.InstitutionModel::getLoginUrl());
                exit;
            }

        }

    }