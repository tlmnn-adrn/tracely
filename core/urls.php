<?php

    //Laden der Klassen, damit diese verwendet werden können
    require_once "app/controller/home/home.php";
    require_once "app/controller/user/user.php";
    require_once "app/controller/user/update.php";


    //Definieren der URLs
    //Die tracely.de/ URL wird als index.php definiert
    //Ist in derURL PLatz für einen Parameter, wird dies mit <*> gekennzeichnet, wobei * der Name des Parameters ist
    $url_patterns = [
      "index.php" => "HomeController",
      "user/<id>" => "UserController",
      "user/update/<id>" => "UserUpdateController",
    ];
