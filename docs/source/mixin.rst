
Mixins
======

Verwendung
----------

Mixins sind Traits. Das bedeutet, sie enthalten eine oder mehrere Funktionen. Als Trait können sie in mehreren Klassen zum Einsatz kommen.
So kann eine Funktion in verschiedensten Klassen verwendet werden. Mixins sollten in Controller Klassen verwendet werden.

Code
....

.. code-block:: php

    TestController extends Controller
        {

        use TestMixin;

Die Init-Funktion
-----------------

Der Controller überprüft in seiner __construct Funktion für jedes installierte Mixin, ob es eine Init Funktion hat.
Ist dies der Fall, wird sie mit den Argumenten als Parameter aufgerufen.

Benennung
.........

Die Init Funktion sollte der Name des Traits (mit kleinem ersten Buchstaben) gefolgt einem Init sein.
Das Trait *TestTrait* sollte also die Init-Funktion *testTraitInit(...$arguments)* haben.

Vorhandene Mixins
-----------------

LoginRequiredMixin
..................

Funktion
~~~~~~~~

Mit diesem Mixin können Seiten gekennzeichnet werden, für die es nötig ist, angemeldet zu sein.
Ist der Benutzer nicht angemeldet, wird er zur Anmeldeseite weitergeleitet.

Code
~~~~

.. code-block:: php

    trait LoginRequiredMixin{

        function loginRequiredMixinInit($arguments=[]){

            if(!AuthModel::isLoggedIn()){
                header('Location: '.AuthModel::getLoginUrl());
                exit;
            }

        }

    }

LoginRedirectMixin
..................

Funktion
~~~~~~~~

Dieses Mixin leitet schon angemeldete Benutzer weiter. Es kann zum Beispiel verwendet werden,
um angemeldete Besucher von der Login-Seite automatisch zur Einstellungs-Seite seines Accounts weiterzuleiten.

Code
~~~~

.. code-block:: php

    trait LoginRedirectMixin{

        function loginRedirectMixinInit($arguments=[]){

            if(AuthModel::isLoggedIn()){
                header('Location: '.AuthModel::getLogoutSuccessUrl());
                exit;
            }

        }

    }

UserPassesTestMixin
...................

Funktion
~~~~~~~~

Dieses Mixin ruft in seiner Init-Funktion die Methode *testFunc(...$arguments)* des Controllers auf.
Dafür muss zuerst eine *testFunc* im Controller definiert werden.
Returnt die *testFunc* False, wird eine 404-Seite angezeigt.

Code
~~~~

.. code-block:: php

    trait UserPassesTestMixin{

        abstract function testFunc();

        function userPassesTestMixinInit($arguments=[]){

            if(!$this->testFunc(...$arguments)){
                new BaseError('404', 'Du darfst diese Seite nicht ansehen', 404);
            }

        }

    }