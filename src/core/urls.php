<?php

    //Laden der Klassen, damit diese verwendet werden können
    require_once "app/controller/home/home.php";
    require_once "app/controller/impressum/impressum.php";
    require_once "app/controller/kontakt/kontakt.php";


    /*??????? muss dann noch raus die 2 Zielen*/
    require_once "app/controller/user/user.php";
    require_once "app/controller/user/update.php";

    require_once "app/controller/login/login.php";
    require_once "app/controller/user/login.php";
    require_once "app/controller/institution/login.php";

    require_once "app/controller/registration/registration.php";
    require_once "app/controller/user/registration.php";
    require_once "app/controller/institution/registration.php";

    require_once "app/controller/backend/backend.php";


    //Definieren der URLs
    //Die tracely.de/ URL wird als index.php definiert
    //Ist in der URL PLatz für einen Parameter, wird dies mit <*> gekennzeichnet, wobei * der Name des Parameters ist

    Url::add('index', '', 'HomeController');
    Url::add('impressum', 'impressum/', 'ImpressumController');
    Url::add('kontakt', 'kontakt/', 'KontaktController');

    Url::add('login', 'login/', 'LoginController');
    Url::add('login-user', 'login/user/', 'UserLoginController');
    Url::add('login-institution', 'login/institution/', 'InstitutionLoginController');

    Url::add('registrierung', 'registrierung/', 'RegistrationController');
    Url::add('registrierung-user', 'registrierung/user/', 'UserRegistrationController');
    Url::add('registrierung-institution', 'registrierung/institution/', 'InstitutionRegistrationController');

    Url::add('backend', 'backend/', 'BackendController');

    StaticUrl::add('static', 'static/');
