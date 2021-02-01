<?php
    require_once "../app/controller/home/home.php";
    require_once "../app/controller/user/user.php";
    require_once "../app/controller/user/update.php";

    $url_patterns = [
      "home/" => "HomeController",
      "user/<id>" => "UserController",
      "user/update/<id>" => "UserUpdateController",
    ];
