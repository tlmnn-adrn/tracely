<?php

    class AuthModel extends Model{

        protected static $userObject;

        //Funktion, die die Url zurückgibt, zu der nach erfolgreichem Login witergeleitet wird
        //Ermöglicht es, die in settings.php festgelegte zu überschreiben
        public static function getLoginSuccessUrl(){
            return $_ENV['LoginSuccessUrl'];
        }

        public static function getLoginUrl(){
            return $_ENV['LoginUrl'];
        }

        //Login Funktion
        public static function login($email, $password, $redirect=FALSE){

            //Verwenden von Filtered List statt get, da get bei einer ungültigen E-Mail Adresse einen 404 Fehler erzeugen würde
            $user = static::filtered_list('email=?', [$email]);

            //Gibt es 0 Benutzer mit dieser E-Mail Adresse, sind die Login-Daten falsch
            if(count($user) != 1){
                return FALSE;
            }

            $user = $user[0];

            if(!$user->passwordEquals($password)){
                return FALSE;
            }

            static::$userObject = $user;
            $_SESSION['userId'] = $user->getField('id');
            $_SESSION['userType'] = get_class($user);

            if($redirect){
                header('Location: '.static::getLoginSuccessUrl());
                exit;
            }

            return TRUE;

        }

        public static function logout($redirect=FALSE){

            if(static::isLoggedIn()){
                $_SESSION['userId'] = NULL;
                $_SESSION['userType'] = NULL;
                static::$userObject = NULL;
            }

            if($redirect){
                header('Location: '.static::getLoginUrl());
                exit;
            }

        }

        public static function isLoggedIn(){

            $class = get_called_class();

            if($class=='AuthModel'){
                if(isset(static::$userObject)){
                    return TRUE;
                }
    
                if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
                    return TRUE;
                }
            }else{
                if(isset(static::$userObject) && get_class(static::$userObject)==$class){
                    return TRUE;
                }
    
                if(isset($_SESSION['userId']) && isset($_SESSION['userType']) && $_SESSION['userType']==$class){
                    return TRUE;
                }
            }

            return FALSE;

        }

        public static function getUserObject(){

            $class = get_called_class();

            if($class=='AuthModel'){
                if(isset(static::$userObject)){
                    return static::$userObject;
                }
    
                if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
    
                    $userModel = $_SESSION['userType'];
    
                    $id = $_SESSION['userId'];
                    $object = $userModel::get('id=?', [$id]);
                    return $object;
    
                }
            }else{
                if(isset(static::$userObject) && get_class(static::$userObject)==$class){
                    return static::$userObject;
                }
    
                if(isset($_SESSION['userId']) && isset($_SESSION['userType']) && $_SESSION['userType']==$class){
    
                    $userModel = $_SESSION['userType'];
    
                    $id = $_SESSION['userId'];
                    $object = $userModel::get('id=?', [$id]);
                    return $object;
    
                }
            }            

            return NULL;

        }




        //------------------------------Non-Static------------------------------

        public function passwordEquals($password){

            $field = $this->fields['passwort'];
            return $field->equals($password);

        }

    }