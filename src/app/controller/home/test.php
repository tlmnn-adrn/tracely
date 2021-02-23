<?php

    class TestController extends Controller
    {

        use DrawTrennerMixin;

        protected $template = 'home/home.php';

        protected function get($request) {

            //$user = InstitutionModel::getUserObject();
            $user = new InstitutionModel();
            echo('<form method="POST">');
            echo($user->renderField('name', 'name').'<br>');
            echo($user->renderField('passwort', 'passwort', 'passwort', 'register').'<br>');
            echo($user->renderField('adresse', 'adresse').'<br>');
            echo($user->renderField('stadt', 'stadt').'<br>');
            echo($user->renderField('plz', 'plz').'<br>');
            echo($user->renderField('email', 'email').'<br>');
            echo($user->renderField('institutionsartId', 'institutionsart').'<br>');
            echo('<input type="submit", value="submit"/>');
            echo('</form>');

        //$this->render();
        }
        protected function post($request) {
        //$this->render();

            $user = new InstitutionModel();

            $user->name = $request['name'];
            $user->setPassword('passwort', $request['passwort'], $request['passwortWiederholen']);
            $user->adresse = $request['adresse'];
            $user->stadt = $request['stadt'];
            $user->plz = $request['plz'];
            $user->email = $request['email'];
            $user->institutionsartId = $request['institutionsartId'];

            $user->create();
            echo('<form method="POST">');
            echo($user->renderField('name', 'name').'<br>');
            echo($user->renderField('passwort', 'passwort', 'passwort', 'register').'<br>');
            echo($user->renderField('adresse', 'adresse').'<br>');
            echo($user->renderField('stadt', 'stadt').'<br>');
            echo($user->renderField('plz', 'plz').'<br>');
            echo($user->renderField('email', 'email').'<br>');
            echo($user->renderField('institutionsartId', 'institutionsart').'<br>');
            echo('<input type="submit", value="submit"/>');
            echo('</form>');
        }

    }
