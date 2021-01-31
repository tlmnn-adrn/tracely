<?php

    require_once('../app/controller/home.php');
    require_once('../app/controller/user.php');

    $url_patterns = [
        'home/' => 'HomeController',
        'user/<id>' => 'UserController',
    ];