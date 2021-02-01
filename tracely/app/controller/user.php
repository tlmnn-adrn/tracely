<?php

    require_once '../core/base/controller/controller.php';
    require_once '../core/404.php';

    class UserController extends Controller{

        protected $template = 'user/detail.php'; 

        protected function get($request, $arguments){

            $this->includeModel('user');

            $object = UserModel::getById($arguments['id']);

            $context = [
                'object' => $object,
            ];

            $this->render($context);
        }

        protected function post($request, $arguments){
        }

    }