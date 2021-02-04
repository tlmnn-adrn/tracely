<?php

    //Laden der Klassen, damit diese verwendet werden können
    require_once "app/controller/home/home.php";
    require_once "app/controller/user/user.php";
    require_once "app/controller/user/update.php";
    require_once "app/controller/user/login.php";
    require_once "app/controller/user/registration.php";


    //Definieren der URLs
    //Die tracely.de/ URL wird als index.php definiert
    //Ist in der URL PLatz für einen Parameter, wird dies mit <*> gekennzeichnet, wobei * der Name des Parameters ist
    
    $urlPatterns = [
      'index' => new UrlPattern('index.php', 'HomeController'),
      'user-login' => new UrlPattern('login/', 'UserLoginController'),
      'user-register' => new UrlPattern('registrierung/', 'UserRegistrationController'),
      'user-detail' => new UrlPattern('user/<id>', 'UserController'),
      'user-update' => new UrlPattern('user/update/<id>', 'UserUpdateController'),


      'static' => new StaticUrlPattern('static')
    ];