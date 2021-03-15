<?php

    class AuthModel extends Model{

        protected static $userObject;

        //Funktion, die die Url zurückgibt, zu der nach erfolgreichem Login witergeleitet wird
        //Ermöglicht es, die in settings.php festgelegte zu überschreiben
        public static function getLoginSuccessUrl(){
            return Url::find($_ENV['LoginSuccessUrl']);
        }

        //Funktion, die die URL zurückgibt, bei der man sich anmelden kann
        public static function getLoginUrl(){
            return Url::find($_ENV['LoginUrl']);
        }

        //Gibt die URL zurück, die aufgerufen wird, wenn man sich erfolgreich abgemeldet hat
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

            //Merke wichtiger Anmeldedaten in der Session
            static::$userObject = $user;
            $_SESSION['userId'] = $user->id;
            $_SESSION['userType'] = get_class($user);

            $rememberClassName = 'Remember'.static::class;

            //Angemeldet bleiben mithilfe eines Tokens, welches in der Datenbank und einem Cookie gespeichert wird
            if(class_exists($rememberClassName)){

                //Quelle: https://stackoverflow.com/questions/1354999/keep-me-logged-in-the-best-approach

                //Generierung eines zufälligne Tokens
                $generator = new RandomStringGenerator;
                $token = $generator->generate(64);

                //Schreiben des Tokens in die Datenbank
                //Erstellen eines neuen Datensatzes in der remember{Modellname} Tabelle, mit den Werten der Id des angemeldeten Benutzers und des Tokens
                $rememberObject = new $rememberClassName();
                $rememberObject->authId = $user->id;
                $rememberObject->token = $token;
                $rememberObject->create();

                //Erstellen des Cookies, bestiehend aus der UserID, dem Token und einem gehashten Wert aus beiden, damit der Cokkie fälschungssciher ist
                $cookie = $user->id.':'.static::class.':'.$token;
                $mac = hash_hmac('sha256', $cookie, $_ENV['secret_key']);

                $cookie .= ':'.$mac;

                setcookie('rememberMe', $cookie, time()+3600*24*31*12, '/');

            }

            //Nach erfolgreicher Anmeldung wird zu der Url weitergeleitet, welche von getLoginSuccessUrl() bestimmt wird
            if($redirect){

                //Hat der Benutzer vorher versucht, eine URL aufzurufen, die er nicht sehen durfte, weil er nicht angemeldet ist, wird er zu dieser weitergeleitet
                if(isset($_SESSION['rememberUrl'])){

                    $url = $_SESSION['rememberUrl'];
                    $_SESSION['rememberUrl'] = NULL;

                    header('Location: '.$url);
                    exit;
                }

                header('Location: '.static::getLoginSuccessUrl());
                exit;
            }

            return TRUE;

        }

        //Abmelden des Benutzers
        public static function logout($redirect=TRUE){

            //Löschung des Cookies und der Session
            setcookie('rememberMe', '', -1, '/');
            $_SESSION['userId'] = NULL;
            $_SESSION['userType'] = NULL;
            static::$userObject = NULL;

            //Weiterleitung zur abmelde URL
            if($redirect){
                header('Location: '.static::getLogoutSuccessUrl());
                exit;
            }

        }

        //Überprüfung, ob der Benutzer angemeldet ist
        public static function isLoggedIn(){

            //Unterschiedliches Verhalten, je nachdem ob die generelle AuthModel Klasse aufgerufen wurde oder eine Unterklasse
            if(static::class=='AuthModel'){

                //Wenn ein objekt in der Klasse gespeichert ist, ist der Benutzer noch angemeldet
                if(isset(static::class::$userObject)){
                    return TRUE;
                }

                //Sind noch Anmeldedaten in der Session gespeichert, ist der Benutzer angemeldet
                if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
                    return TRUE;
                }

                //Ist ein Anmeldecookie vorhanden, der Cookie gültig und der Token in der remember Tabelle mit der zugehörigen UserId tatsächlich zu finden, ist der Benutzer angemeldet
                if(isset($_COOKIE['rememberMe'])){
                    $cookie = $_COOKIE['rememberMe'];

                    //Entpacken des Cookies in die einzelnen Werte
                    [$userId, $userClass, $token, $mac] = explode(':', $cookie);

                    //Überprüfung, ob der Hash am Ende des Cookies gültig ist
                    if(!hash_equals(hash_hmac('sha256', $userId.':'.$userClass.':'.$token, $_ENV['secret_key']), $mac)){
                        return FALSE;
                    }

                    //Überprüfung, ob der Token mit der angegebenen UserId tatsächlich in der remembertabelle zu finden ist
                    //Ist dies der Fall, ist der Benutzer wirklich angemeldet
                    $rememberObject = 'Remember'.$userClass;
                    $results = $rememberObject::getRememberMe($userId, $token);

                    if(count($results)){
                        return TRUE;
                    }
                }

            }else{

                //Wie oben, nur dass hier noch überprüft wird, ob der angemeldete Benutzer von derselben Benutzerklasse ist, wie die aufgerufene Benutzerklasse

                if(isset(static::$userObject) && get_class(static::$userObject)==static::class){
                    return TRUE;
                }

                if(isset($_SESSION['userId']) && isset($_SESSION['userType']) && $_SESSION['userType']==static::class){
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

                    //Übernehmen der Anmeldedaten in die Session
                    $_SESSION['userId'] = $userId;
                    $_SESSION['userType'] = $userClass;

                    if(count($results)){
                        return TRUE;
                    }
                }
            }

            return FALSE;

        }

        //Ausgabe der Instanz des Benutzermodells des angemeldeten Benutzers
        public static function getUserObject(){

            //Überprüfung, ob der Benutzer angemeldet ist
            if(!static::isLoggedIn()){
                return NULL;
            }

            //Ausgabe der Instanz des Benutzermodells aus dem static Attribut der Benutzerklasse
            if(isset(static::$userObject)){
                return static::$userObject;
            }

            //Ausgabe der Instanz des Benutzermodells mithilfe der in den Cookies gespeicherten Werten
            if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){

                $userModel = $_SESSION['userType'];

                $id = $_SESSION['userId'];

                $sql = new SelectQuery($userModel::$tableName, $userModel);
                $sql->where('id=?', $id);
                $object = $sql->execute()[0];

                return $object;

            }

            return NULL;

        }

        //------------------------------Non-Static------------------------------

        //Überprüfung, ob das angegebene Passwort korrekt ist
        public function passwordEquals($password){

            $field = $this->fields['passwort'];
            return $field->equals($password);

        }

    }
