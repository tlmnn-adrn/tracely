<?php

    class AuthModel extends Model{

        protected static $userObject;

        //Login Funktion
        public static function login($email, $password){

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

            return TRUE;

        }

        public static function logout(){

            $_SESSION['userId'] = NULL;
            static::$userObject = NULL;

        }

        public static function isLoggedIn(){

            if(isset(static::$userObject) || isset($_SESSION['userObject'])){
                return TRUE;
            }

            return FALSE;

        }

        public static function getUserModel(){

            if(isset(static::$userObject)){
                return static::$userObject;
            }

            if(isset($_SESSION['userId'])){

                $id = $_SESSION['userId'];
                $object = static::get('id=?', [$id]);
                return $object;
            }

            return NULL;

        }




        //------------------------------Non-Static------------------------------

        public function passwordEquals($password){

            $field = $this->fields['passwort'];
            return $field->equals($password);

        }

    }