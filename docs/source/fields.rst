
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
        public function set($value);
        public function equals($value);
        public function hasErrors();
        public function render($name);
        public function checkValid();

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

*$required (FALSE): Bool* - Ob das Feld required ist

*$unique (FALSE): Bool* - Ob das Feld unique ist

Code
****

.. code-block:: php

    function __construct(protected $required=FALSE, protected $unique=FALSE){

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

set
~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

Funktion
********

Setzen des Wertes des Feldes, ohne Überprüfung auf Gültigkeit.

Code
****

.. code-block:: php

    function set($value){
        $this->value = $value;
    }

checkValid
~~~~~~~~~~

Parameter
*********

*$value: String* - Der Wert des Feldes, der auf Gültigkeit überprüft werden soll.

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.

Code
****

.. code-block:: php

    function checkValid($value){

        if($this->required && strlen($value) == 0){

            $this->errors[] = $this->errorTypes['requiredButEmptyError'];

        }

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

Überprüft, ob der Wert des Feldes gültig ist.

.. warning:: Es muss noch die unique-Prüfung implementiert werden.


Code
****

.. code-block:: php

    function hasErrors(){
        $this->checkValid();

        return count($this->errors) > 0;
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

Methoden
........

__construct
~~~~~~~~~~~

Parameter
*********

*$required (FALSE): Bool* - Ob das Feld required ist

*$unique (FALSE): Bool* - Ob das Feld unique ist

*$maxLength (255): Int* - Die maximale Länge des Wertes

Code
****

.. code-block:: php

    function __construct($required=FALSE, $unique=FALSE, protected $maxLength=255){

        return parent::__construct($required, $unique);
            
    }

checkValid
~~~~~~~~~~

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.

Code
****

.. code-block:: php

    function checkValid(){

        if(strlen($this->value)>$this->maxLength){

            $this->errors[] = $this->errorTypes['toLongError'];

        }

        return parent::checkValid();

    }

EmailField
----------

extends TextField

Methoden
........

checkValid
~~~~~~~~~~

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
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

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
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
        }

        if(!preg_match('/^[0-9]+$/', $value) && !is_int($value)){
            $this->errors[] = $this->errorTypes['textInNumberFieldError'];
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

Funktion
********

Schreibt die ursprünglichen Werte in die Attribute der Klasse.
Ein IdField ist immer required und unique.

Code
****

.. code-block:: php

    function __construct(){
    
        parent::__construct(TRUE, TRUE);
            
    }

set
~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

Funktion
********

Überprüft, ob das Id-Feld schon einen Wert hat. Ist dies nicht der Fall, wird dem Id-Feld der neue Wert zugewiesen.
Hat es aber schon einen Wert, wird eione Fehlermeldung erzeugt, denn der Wert sollte nicht geändert werden.

Code
****

.. code-block:: php

    function set($value){

        if($this->value){
            throw new BaseError('Interner', 'Du solltest den Wert des Id-Feldes nicht ändern.', 500);

            return FALSE;
        }

        parent::set($value);

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

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
Es wird auch überprüft, ob es in der anderen Tabelle wirklich eine Zeile mit dieser id gibt.

Code
****

.. code-block:: php

    function checkValid($value){
            
        if(!$this->model::getById($value, FALSE)){
            $this->errors[] = $this->errorTypes['foreignKeyDoesntExist'];
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

*$minLength (6): Int* - Die Mindestlänge des Passwortes

Code
****

.. code-block:: php

    function __construct(protected $minLength=6){
        
        return parent::__construct(TRUE, FALSE);
        
    }

set
~~~

Parameter
*********

*$value: String* - Der Wert auf den das Feld gesetzt werden soll.

Funktion
********

Überprüft, ob das Passwort-Feld schon einen Wert hat. Ist dies nicht der Fall, wird dem Passwort-Feld der neue Wert zugewiesen.
Hat es aber schon einen Wert, wird eine Fehlermeldung erzeugt, denn der Wert sollte über dei Methode setPassword geändert werden.

Code
****

.. code-block:: php

    function set($value){

        if($this->value){
            throw new BaseError('Interner', 'Um den Wert des Passwort-Feldes zu ändern, benutze die Methode setPassword()!', 500);

            return FALSE;
        }

        parent::set($value);

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

*$value: String* - Das auf Gültigkeit zu überprüfende Passwort

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
Dabei wird auch überprüft, ob das neue Passwort lang genug ist.

Code
****

.. code-block:: php

    function checkValid($value=''){

        if(strlen($this->value)<$this->minLength){
            
            $this->errors[] = $this->errorTypes['passwordShortError'];

        }

        return parent::checkValid();

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

setPassword
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

    function setPassword($value, $repeatValue='', $oldValue=''){

        if($repeatValue!=$value){

            $this->errors[] = $this->errorTypes['passwordsDontMatchError'];

        }
        
        if(!$this->equals($oldValue)){

            $this->errors[] = $this->errorTypes['oldPasswordWrongError'];

        }

        $this->checkValid($value);

        if(!$this->hasErrors()){
            $this->value = $this->hash($value);
        }

    }

hasErrors
~~~~~~~~~

Funktion
********

Überprüft, ob es einen erfolglosen Versuch gabm das Passwort zu ändern.

Code
****

.. code-block:: php

    function hasErrors(){
        return count($this->errors) > 0;
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

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
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

        }

        if (!preg_match('/^[0-9]+$/', $value)){

            $this->errors[] = $this->errorTypes['textInNumberFieldError'];

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

Funktion
********

Überprüft den Wert des Feldes auf Gültigkeit.
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

        }

        if(!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $value)){

            $this->errors[] = $this->errorTypes['notAPhoneNumberError'];
                
        }

        return parent::checkValid($value);

    }