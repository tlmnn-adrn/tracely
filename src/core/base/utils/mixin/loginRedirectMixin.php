<?php

    //Wenn der Benutzer schon angemeldet ist, und die Seite aufruft, wird er angemeldet
    //Ist zum Beipsiel sinnvoll bei der Anmeldeseite
    trait LoginRedirectMixin{

        function loginRedirectMixinInit($arguments=[]){

            if(AuthModel::isLoggedIn()){
                header('Location: '.AuthModel::getLogoutSuccessUrl());
                exit;
            }

        }

    }
