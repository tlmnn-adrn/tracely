<?php

    require_once '../core/base/controller/controller.php';

    class UserController extends Controller{

        protected $template = 'user/detail.php'; 

        protected function get($request, $arguments){

            $context = [
                'id' => $arguments['id'],
            ];

            $this->render($context);
        }

        protected function post($request, $arguments){
        }

    }