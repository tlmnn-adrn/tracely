
AuthModel
=========

extends Model

Attribute
---------

userObject
..........

*Typ:          AuthModel*

*Sichtbarkeit: protected*

*Static:       Ja*

Hier wird das Objekt des angemeldeten Benutzers gespeichert.

Methoden
--------

getLoginSuccessUrl
..................

Funktion
~~~~~~~~

Returnt die Url, die nach erfolgreichem Login aufgerufen werden soll.

Code
~~~~

.. code-block:: php

    public static function getLoginSuccessUrl(){
        return $_ENV['LoginSuccessUrl'];
    }

getLoginUrl
...........

Funktion
~~~~~~~~

Returnt die Url, unter die Login Seite zu finden ist.

Code
~~~~

.. code-block:: php

    public static function getLoginUrl(){
        return $_ENV['LoginUrl'];
    }

getLogoutSuccessUrl
...................

Funktion
~~~~~~~~

Returnt die Url, die nach erfolgreichem Logout aufgerufen werden soll.

Code
~~~~

.. code-block:: php

    public static function getLogoutSuccessUrl(){
        return $_ENV['LogoutSuccessUrl'];
    }

login
.....

Parameter
~~~~~~~~~

*$email: String* - Die E-Mail Adresse, die der Benutzer angegeben hat

*$passwort: String* - Das Passwort, das der Benutzer angegeben hat

*$redirect (TRUE): Bool* - Soll nach erfolgreichem Login zu der Seite, die *getLoginSuccessUrl* zurückgibt weitergeleitet werden?

Funktion
~~~~~~~~

Überprüft, ob die angegebenen Anmeldedaten korrekt sind. Ist dies der Fall, wird das Objekt des AuthModels, welches zum User gehört, im Attribut *userObject*
gespeichert und die Id und Klasse des Objektes in der Session gespeichert.

Code
~~~~

.. code-block:: php

    public static function login($email, $password, $redirect=TRUE){

        $user = static::filtered_list('email=?', [$email]);

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


logout
......

Parameter
~~~~~~~~~

*$redirect (TRUE): Bool* - Soll nach erfolgreichem Logout zu der Seite, die *getLogoutSuccessUrl* zurückgibt weitergeleitet werden?

Funktion
~~~~~~~~

Meldet den Use ab. Löscht dafür die Daten aus der Session und das *$userObject*.

Code
~~~~

.. code-block:: php

    public static function logout($redirect=TRUE){

        if(static::isLoggedIn()){
            $_SESSION['userId'] = NULL;
            $_SESSION['userType'] = NULL;
            static::$userObject = NULL;
        }

        if($redirect){
            header('Location: '.static::getLogoutSuccessUrl());
            exit;
        }

    }

isLoggedIn
..........

Funktion
~~~~~~~~

Überprüft, ob ein User angemeldet ist. Unterscheidet dabei auch zwischen verschiedenen User-Unterklassen.
Erweitern zum Beispiel die Unterklassen VerkäuferModel und KäuferModel das AuthModel und ein Verkäufer ist angemeldet,
returnt *KäuferModel::isLoggedIn()* FALSE, *VerkäuferModel::isLoggedIn()* und *AuthModel::isLoggedIn()* returnen TRUE.

Code
~~~~

.. code-block:: php

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

getUserObject
.............

Funktion
~~~~~~~~

Returnt das Objekt des gerade angemeldeten Users. Ist gerade niemand angemeldet, wird NULL returnt.

Code
~~~~

.. code-block:: php

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

passwordEquals
..............

Parameter
~~~~~~~~~

*$password: String* - Das Passwort, das auf Richtigkeit überprüft werden soll

Funktion
~~~~~~~~

Überprüft, ob das angegebene Passwort korrekt ist.

Code
~~~~

.. code-block:: php
    
    public function passwordEquals($password){

        $field = $this->fields['passwort'];
        return $field->equals($password);

    }