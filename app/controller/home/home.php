<?php

  class HomeController extends Controller
  {

    use InstitutionLoginRequiredMixin;

    protected $template = 'home/home.php';

    protected function get($request) {

      //AuthModel::logout(FALSE);

      echo('AuthModel: '.AuthModel::isLoggedIn().'<br>');
      echo('UserModel: '.UserModel::isLoggedIn().'<br>');
      echo('InstitutionModel: '.InstitutionModel::isLoggedIn().'<br>');

      echo('Log In <br>');
      //InstitutionModel::login('gdb@lernsax.de', '654321', FALSE);
      //UserModel::login('adrian.tilmann@gmail.com', '654321', FALSE);
      
      echo('AuthModel: '.AuthModel::isLoggedIn().'<br>');
      echo('UserModel: '.UserModel::isLoggedIn().'<br>');
      echo('InstitutionModel: '.InstitutionModel::isLoggedIn().'<br>');

      $this->render();
    }
    protected function post($request) {
      $this->render();
    }

  }
