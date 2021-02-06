
Felder
======

Felder (fields) sind dazu da, umm im Modell einzustellen, welche Spalten eine Tabelle in der Datenbank hat. Ein Feld entspricht
dabei einer Zeile. Es gibt verschiedene Arten von Feldern, die für verschiedene Datentypen gedacht sind.

Field
-----

Bei Field handelt es sich um ein Interface. Es gibt viele Felder, die Field implementieren.

Code
....

.. code-block:: php

    interface Field{

        public function get();
        public function setValue($value);
        public function updateValue($value, $unique);
        public function equals($value);
        public function isUnique();
        public function hasErrors();
        public function render($name);

    }

BaseField
---------

Funktion
........

BaseField dient vor allem dazu, eine Basis zu stellen, welche andere Felder erweitern.

Attribute
.........

value
~~~~~

*Typ:          String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Der Wert des Feldes in der Datenbank.

required
~~~~~~~~

*Typ:          Bool*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt an, ob das Feld zwingend benötigt wird.

unique
~~~~~~

*Typ:          Bool*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt an, ob das Feld einzigartig ist.

errors
~~~~~~

*Typ:          Array*

*Sichtbarkeit: Protected*

*Static:       Nein*

Hier werden Fehlermeldungen von Versuchen gespeichert, dem Feld einen ungültigen Wert zuzuweisen.

errorTypes
~~~~~~~~~~

*Typ:          Array*

*Sichtbarkeit: Protected*

*Static:       Nein*

Hier werden alle Texte von Fehlermeldungen gespeichert.

template
~~~~~~~~

*Typ:          String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Das Template, welches gerendert werden soll, wenn die Methode *render()* aufgerufen wird.

Methoden
........

__construct
~~~~~~~~~~~

Parameter
*********

*$value (''): String* - Der Wert des Feldes in der Datenbank

*$required (FALSE): Bool* - Ob das Feld required ist

*$unique (FALSE): Bool* - Ob das Feld unique ist

Funktion
********

Schreibt die ursprünglichen Werte in die Attribute der Klasse.

Code
****

.. code-block:: php

    function __construct($value='', $required=FALSE, $unique=FALSE){

        $this->value = $value;
        $this->required = $required;
        $this->unique = $unique;

        require 'core/base/model/fields/errors.php';
        $this->errorTypes = $errorTypes;

    }

get
~~~

Funktion
********

Ausgabe des Wertes des Feldes.

Code
****

.. code-block:: php

    function get(){
        return $this->value;
    }

setValue
~~~~~~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

Funktion
********

Setzen des Wertes des Feldes, ohne Überprüfung auf Gültigkeit.

Code
****

.. code-block:: php

    function setValue($value){
        $this->value = $value;
    }

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert des Feldes, der auf Gültigkeit überprüft werden soll.

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.

Code
****

.. code-block:: php

    function checkValid($value){

        if($this->required && strlen($value) == 0){

            $this->errors[] = $this->errorTypes['requiredButEmptyError'];

            return FALSE;
        }

        return True;

    }


updateValue
~~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

*$unique: Bool* - Vom Modell wird dabei übergeben, ob es schon ein anderes Feld in der Datenbank mit dem Wert gibt

Funktion
********

Überprüft den angegebenen Wert auf Gültigkeit. Wenn er gültig ist, wird das Attribut *$value* mit dem neuen Wert überschrieben.

Code
****

.. code-block:: php

    function updateValue($value, $unique){

        if($this->unique && !$unique){

            $this->errors[] = $this->errorTypes['notUniqueError'];
            return FALSE;
        }

        if($this->checkValid($value)){
            $this->setValue($value);
            return TRUE;
        }

        return FALSE;

    }

isUnique
~~~~~~~~

Funktion
********

Returnt, ob das Feld unique ist.

Code
****

.. code-block:: php

    function isUnique(){
        return $this->unique;
    }

equals
~~~~~~

Parameter
*********

*$value: String* - Der Wert mit dem das Feld verglichen werden soll.

Funktion
********

Prüft, ob der angegebene Parameter mit dem Wert des Feldes übereinstimmt.

Code
****

.. code-block:: php

    function equals($value){
        return($value==$this->value);
    }

hasErrors
~~~~~~~~~

Funktion
********

Überprüft, ob es erfolglose Versuche gab, den Wert des Feldes neu zu setzen.

Code
****

.. code-block:: php

    function hasErrors(){
        return count($this->errors)>0;
    }

render
~~~~~~

Parameter
*********

*$name: String* - Der Name des Input-Feldes

*$placeholder: String* - Der Placeholder der angezeigt werden soll. Leer, wenn keiner angezeigt werden soll.

*$class: String* - Hier können Klassen für das Input-Feld festgelegt werden.

Funktion
********

Rendert das zu dem Feldtyp gehörige Input-Feld.

Code
****

.. code-block:: php

    function render($name, $placeholder="", $class=""){

        $path = 'core/base/model/fields/templates/'.$this->template;
        require($path);

    }

TextField
---------

extends BaseField

Attribute
.........

maxLength
~~~~~~~~~

*Typ:          Int*

*Sichtbarkeit: Protected*

*Static:       Nein*

Die maximale Länge, die der Wert des Textfeldes haben darf.

Mathoden
........

__construct
~~~~~~~~~~~

Parameter
*********

*$value (''): String* - Der Wert des Feldes in der Datenbank

*$required (FALSE): Bool* - Ob das Feld required ist

*$unique (FALSE): Bool* - Ob das Feld unique ist

*$maxLength (255): Int* - Die maximale Länge des Wertes

Funktion
********

Schreibt die ursprünglichen Werte in die Attribute der Klasse.

Code
****

.. code-block:: php

    function __construct($value='', $required=FALSE, $unique=FALSE, $maxLength=255){

        $this->maxLength = $maxLength;
        return parent::__construct($value, $required, $unique);
            
    }

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert, der überprüft werden soll

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.

Code
****

.. code-block:: php

    function checkValid($value){

        if(strlen($value)>$this->maxLength){

            $this->errors[] = $this->errorTypes['toLongError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

EmailField
----------

extends TextField

Methoden
........

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert, der überprüft werden soll

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.
Es wird auch überprüft, ob es sich um eine gültige E-Mail Adresse handelt. 

Quellen
*******

https://www.php.net/manual/de/filter.examples.validation.php

Code
****

.. code-block:: php

    function checkValid($value){

        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){

            $this->errors[] = $this->errorTypes['invalidEmailError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }


IntegerField
------------

extends BaseField

Methoden
........

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert, der überprüft werden soll

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.
Es wird auch überprüft, ob es sich um einen numerischen Wert handelt.

Quellen
*******

https://stackoverflow.com/questions/7649752/php-is-numeric-or-preg-match-0-9-validation

Code
****

.. code-block:: php

    function checkValid($value){

        if($this->required && $value == NULL){
            $this->errors[] =$this->errorTypes['requiredButEmptyError'];

            return FALSE;
        }

        if(!preg_match('/^[0-9]+$/', $value) && !is_int($value)){
            $this->errors[] = $this->errorTypes['textInNumberFieldError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

IdField
-------

extends IntegerField

Methoden
........

__construct
~~~~~~~~~~~

Parameter
*********

*$value (''): String* - Der Wert des Feldes in der Datenbank

Funktion
********

Schreibt die ursprünglichen Werte in die Attribute der Klasse.
Ein IdField ist immer required und unique.

Code
****

.. code-block:: php

    function __construct($value=''){
    
        $this->value = $value;
        $this->required = TRUE;
        $this->unique = TRUE;

        require 'core/base/model/fields/errors.php';
        $this->errorTypes = $errorTypes;
    }

updateValue
~~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

*$unique: Bool* - Vom Modell wird dabei übergeben, ob es schon ein anderes Feld in der Datenbank mit dem Wert gibt

Funktion
********

Erzeugt nur eine Fehlermeldung. Der Wert des Id-Fields sollte nicht geändert werden.

Code
****

.. code-block:: php

    function updateValue($value, $unique){

        $this->errors[] = $this->errorTypes['setIdError'];

        return FALSE;

    }

ForeignKeyField
---------------

extends IntegerField

Attribute
.........

model
~~~~~

*Typ:          String*

*Sichtbarkeit: Protected*

*Static:       Nein*

Das Model, zu welchem der ForeignKey verweist.

options
~~~~~~~

*Typ:          Array*

*Sichtbarkeit: Protected*

*Static:       Nein*

Eine Liste der möglichen Auswahloptionen. Wenn sie leer ist, wird davon ausgegangen, dass alle Objekte des anderen Modells verwendt werden können.

Methoden
........

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert, der überprüft werden soll

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.
Es wird auch überprüft, ob es in der anderen Tabelle wirklich eine Zeile mit dieser id gibt.

Code
****

.. code-block:: php

    function checkValid($value){
            
        if(!$this->model::getById($value, FALSE)){
            $this->errors[] = $this->errorTypes['foreignKeyDoesntExist'];
            return FALSE;
        }

        return parent::checkValid($value);

    }

list
~~~~

Funktion
********

Returnt die Liste der Optionen. Ist diese leer, wird eine Liste mit allen Modellen des anderen Modells returnt.

Code
****

.. code-block:: php

    protected function list(){

        if(count($this->options)>0){
            return $this->options;
        }

        return $this->model::list();

    }

setOptions
~~~~~~~~~~

Parameter
*********

*$options ([]): Array* - Liste möglicher Auswahloptionen

Funktion
********

Setzen der möglichen Modelle, zu denen dieser ForeignKey verweisen kann.

Code
****

.. code-block:: php

    function setOptions($options=[]){

        $this->options = $options;

    }


render
~~~~~~

Parameter
*********

*$name: String* - Der Name des Input-Feldes

*$placeholder: String* - Der Placeholder der angezeigt werden soll. Leer, wenn keiner angezeigt werden soll.

*$class: String* - Hier können Klassen für das Input-Feld festgelegt werden.

Funktion
********

Rendert ein Select-Feld in HTML mit den *$options* als Auswahlmöglichkeit.

Code
****

.. code-block:: php

    function render($name, $placeholder='', $class=''){

        $options = $this->list();

        $path = 'core/base/model/fields/templates/'.$this->template;
        require($path);

    }

PasswordField
-------------

extends BaseField

Attribute
.........

minLength
~~~~~~~~~

*Typ:          Int*

*Sichtbarkeit: Protected*

*Static:       Nein*

Die Mindestlänge des Passwort.

Methoden
........

__construct
~~~~~~~~~~~

Parameter
*********

*$value (''): String* - Der Wert des Feldes in der Datenbank

*$minLength (6): Int* - Die Mindestlänge des Passwortes

Funktion
********

Schreibt die ursprünglichen Werte in die Attribute der Klasse.

Code
****

.. code-block:: php

    function __construct($value='', $minLength=6){
        
        $this->minLength = $minLength;
        return parent::__construct($value, TRUE, FALSE);
        
    }

equals
~~~~~~

Parameter
*********

*$value: String* - Das eingegebene Passwort

Funktion
********

Prüft, ob das eingegebene Passwort korrekt ist.

Code
****

.. code-block:: php

    function equals($value){

        if($this->value==""){
            return TRUE;
        }
        
        return password_verify($value, $this->value);
    }

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert des Feldes, der auf Gültigkeit überprüft werden soll.

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit. Dabei wird auch überprüft, ob das neue Passwort lang genug ist.

Code
****

.. code-block:: php

    function checkValid($value){

        if(strlen($value)<$this->minLength){
            
            $this->errors[] = $this->errorTypes['passwordShortError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

hash
~~~~

Parameter
*********

*$value: String* - Das zu hashende Passwort

Funktion
********

Hasht das Pangegebene Passwort.

Code
****

.. code-block:: php

    function hash($value){
        return password_hash($value, PASSWORD_DEFAULT);
    }

updateValue
~~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

*$unique: Bool* - Wird ignoriert

*$repeatetValue: String* - Beim registrieren und Passwort ändern die zweite Eingabe des Passwortes

*$oldValue: String* - Beim Passwort ändern das alte Passwort

Funktion
********

Überprüft den angegebenen Wert auf Gültigkeit. 
Beim Registrieren und Passwort ändern wird auch überprüft, ob beide eingegebenen Passwörter identisch waren. 
Beim Ändern des Passwortes wird auch überprüft, ob das alte Passwort korrekt ist.
Wenn er gültig ist, wird das Attribut *$value* mit dem neuen Wert überschrieben.

Code
****

.. code-block:: php

    function updateValue($value, $unique, $repeatValue='', $oldValue=''){

        if($repeatValue!=$value){

            $this->errors[] = $this->errorTypes['passwordsDontMatchError'];

            return FALSE;
        }
        
        if(!$this->equals($oldValue)){

            $this->errors[] = $this->errorTypes['oldPasswordWrongError'];

            return FALSE;
        }

        if($this->checkValid($value)){
            $value = $this->hash($value);
            $this->setValue($value);
            return TRUE;
        }

        return FALSE;

    }

render
~~~~~~

Parameter
*********

*$name: String* - Der Name des Input-Feldes

*$placeholder: String* - Der Placeholder der angezeigt werden soll. Leer, wenn keiner angezeigt werden soll.

*$class: String* - Hier können Klassen für das Input-Feld festgelegt werden.

*$type: String* - Gibt an, ob das Passwortfeld im Kontext einer Anmeldung / Registrierung / Passwortänderung angezeigt werden soll.

Funktion
********

Rendert das zu dem Feldtyp gehörige Input-Feld.
Unterscheidet zwischen Anmeldung, Registrierung und Passwortänderung.

Code
****

.. code-block:: php

    function render($name, $placeholder="", $class="", $type=""){
                
        $path = 'core/base/model/fields/templates/'.$this->template;
        require($path);

    }

PlzField
--------

extends BaseField

Methoden
........

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert des Feldes, der auf Gültigkeit überprüft werden soll.

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.
Es wird dabei auch überprüft, ob die Postleitzahl auch wirklich 5 Stellen lang und numerisch ist.

Quellen
*******

https://stackoverflow.com/questions/48496291/check-if-string-only-contains-numbers-in-php

Code
****

.. code-block:: php

    function checkValid($value){

        if(strlen($value)!=5){

            $this->errors[] = $this->errorTypes['plzError'];

            return FALSE;
        }

        if (!preg_match('/^[0-9]+$/', $value)){

            $this->errors[] = $this->errorTypes['textInNumberFieldError'];

            return FALSE;
        }

        return parent::checkValid($value);

    }

TelefonField
------------

extends BaseField

Attribute
.........

length
~~~~~~

*Typ:          int*

*Sichtbarkeit: Protected*

*Static:       Nein*

Gibt die benötigte Länge der Telefonnummer an (standartmäßig 13).

Methoden
........

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert des Feldes, der auf Gültigkeit überprüft werden soll.

Funktion
********

Überprüft den aktellen Parameter auf gültigkeit.
Es wird auch überprüft, ob es sich um eine gültige Telefonnnummer handelt.

Quellen
*******

https://www.xspdf.com/resolution/56792114.html

Code
****

.. code-block:: php

    function checkValid($value){

        if(strlen($value) != $this->length){

            $this->errors[] = $this->errorTypes['notAPhoneNumberError'];

            return False;
        }

        if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $value)){

            $this->errors[] = $this->errorTypes['notAPhoneNumberError'];
                
            return False;
        }

        return parent::checkValid($value);

    }