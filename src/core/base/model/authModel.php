<?php

    class AuthModel extends Model{

        protected static $userObject;

        //Funktion, die die Url zurückgibt, zu der nach erfolgreichem Login witergeleitet wird
        //Ermöglicht es, die in settings.php festgelegte zu überschreiben
        public static function getLoginSuccessUrl(){
            return Url::find($_ENV['LoginSuccessUrl']);
        }

        public static function getLoginUrl(){
            return Url::find($_ENV['LoginUrl']);
        }

        public static function getLogoutSuccessUrl(){
            return Url::find($_ENV['LogoutSuccessUrl']);
        }

        //Login Funktion
        public static function login($email, $password, $redirect=TRUE){

            //Verwenden von Filtered List statt get, da get bei einer ungültigen E-Mail Adresse einen 404 Fehler erzeugen würde
            //$user = static::filtered_list('email=?', [$email]);
            $sql = new SelectQuery(static::$tableName, get_called_class());
            $sql->where('email=?', $email);

            $user = $sql->execute();

            //Gibt es 0 Benutzer mit dieser E-Mail Adresse, sind die Login-Daten falsch
            if(count($user) != 1){
                return FALSE;
            }

            $user = $user[0];

            if(!$user->passwordEquals($password)){
                return FALSE;
            }

            static::$userObject = $user;
            $_SESSION['userId'] = $user->id;
            $_SESSION['userType'] = get_class($user);

            $rememberClassName = 'Remember'.static::class;

            if(class_exists($rememberClassName)){

                //Quelle: https://stackoverflow.com/questions/1354999/keep-me-logged-in-the-best-approach

                $generator = new RandomStringGenerator;
                $token = $generator->generate(64);


                $rememberObject = new $rememberClassName();
                $rememberObject->authId = $user->id;
                $rememberObject->token = $token;
                $rememberObject->create();

                $cookie = $user->id.':'.static::class.':'.$token;
                $mac = hash_hmac('sha256', $cookie, $_ENV['secret_key']);

                $cookie .= ':'.$mac;

                setcookie('rememberMe', $cookie, time()+3600*24*31*12, '/');

            }

            if($redirect){

                if(isset($_SESSION['rememberUrl'])){
                    header('Location: '.$_SESSION['rememberUrl']);
                    exit;
                }

                header('Location: '.static::getLoginSuccessUrl());
                exit;
            }

            return TRUE;

        }

        public static function logout($redirect=TRUE){

            setcookie('rememberMe', '', -1, '/');
            $_SESSION['userId'] = NULL;
            $_SESSION['userType'] = NULL;
            static::$userObject = NULL;

            if($redirect){
                header('Location: '.static::getLogoutSuccessUrl());
                exit;
            }

        }

        public static function isLoggedIn(){

            $class = get_called_class();

            if($class=='AuthModel'){
                if(isset($class::$userObject)){
                    return TRUE;
                }

                if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
                    return TRUE;
                }

                if(isset($_COOKIE['rememberMe'])){
                    $cookie = $_COOKIE['rememberMe'];

                    [$userId, $userClass, $token, $mac] = explode(':', $cookie);

                    if(!hash_equals(hash_hmac('sha256', $userId.':'.$userClass.':'.$token, $_ENV['secret_key']), $mac)){
                        return FALSE;
                    }

                    $rememberObject = 'Remember'.$userClass;
                    $results = $rememberObject::getRememberMe($userId, $token);

                    if(count($results)){
                        return TRUE;
                    }
                }

            }else{
                if(isset(static::$userObject) && get_class(static::$userObject)==$class){
                    return TRUE;
                }

                if(isset($_SESSION['userId']) && isset($_SESSION['userType']) && $_SESSION['userType']==$class){
                    return TRUE;
                }

                if(isset($_COOKIE['rememberMe'])){
                    $cookie = $_COOKIE['rememberMe'];

                    [$userId, $userClass, $token, $mac] = explode(':', $cookie);

                    if($userClass != static::class){
                        return FALSE;
                    }

                    if(!hash_equals(hash_hmac('sha256', $userId.':'.$userClass.':'.$token, $_ENV['secret_key']), $mac)){
                        return FALSE;
                    }

                    $rememberObject = 'Remember'.$userClass;
                    $results = $rememberObject::getRememberMe($userId, $token);

                    if(count($results)){
                        return TRUE;
                    }
                }
            }

            return FALSE;

        }

        public static function getUserObject(){

            $class = get_called_class();

            if(!static::isLoggedIn()){
                return NULL;
            }

            if(isset(static::$userObject)){
                return static::$userObject;
            }

            if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){

                $userModel = $_SESSION['userType'];

                $id = $_SESSION['userId'];

                $sql = new SelectQuery($userModel::$tableName, $userModel);
                $sql->where('id=?', $id);
                $object = $sql->execute()[0];

                return $object;

            }

            if(isset($_COOKIE['rememberMe'])){
                $cookie = $_COOKIE['rememberMe'];

                [$id, $userModel, $token, $mac] = explode(':', $cookie);

                $sql = new SelectQuery($userModel::$tableName, $userModel);
                $sql->where('id=?', $id);
                $object = $sql->execute()[0];

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
